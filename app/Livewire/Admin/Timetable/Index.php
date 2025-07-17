<?php

namespace App\Livewire\Admin\Timetable;

use App\Models\ExternalStaff;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\Timetable;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\TimetableExport;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $timetable_id = null;
    public $class_id, $day = '', $subject_id, $staff_id, $start_time, $end_time, $editId;
    public $search = '', $selectedIds = [], $selectAll = false;
    public $sortBy = 'day', $sortDirection = 'asc', $perPage = 10;
    public $showWeeklyView = false;

    protected $listeners = [
        'refreshTimetable' => '$refresh',
        'resetFilters' => 'resetFilters',
    ];

    protected function rules()
    {
        return [
            'class_id' => 'required|exists:student_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'staff_id' => 'nullable|exists:mysql2.staff,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    public function updated($field)
    {
        if (in_array($field, ['class_id', 'subject_id', 'staff_id', 'day', 'start_time', 'end_time'])) {
            $this->validateOnly($field);
        }

        if ($field === 'selectAll') {
            $this->selectedIds = $this->selectAll ? $this->getTimetables()->pluck('id')->toArray() : [];
        }

        if ($field === 'search') {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.admin.timetable.index', [
            'classes' => StudentClass::orderBy('name')->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'staffs' => ExternalStaff::orderBy('firstname')->get(),
            'timetables' => $this->getTimetables(),
            'weeklyTimetable' => $this->getWeeklyTimetable(),
        ])->extends('layouts.auth-layout')->section('content');
    }

    private function getTimetables()
    {
        return Timetable::query()
            ->when($this->class_id, fn ($q) => $q->where('class_id', $this->class_id))
            ->when($this->day, fn ($q) => $q->where('day', $this->day))
            ->when($this->search, function ($q) {
                $q->whereHas('subject', fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                  ->orWhereHas('staff', fn ($q) => $q->where('firstname', 'like', "%{$this->search}%"))
                  ->orWhereHas('class', fn ($q) => $q->where('name', 'like', "%{$this->search}%"));
            })
            ->with(['class:id,name', 'subject:id,name', 'staff:id,firstname'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->orderBy('start_time')
            ->paginate($this->perPage);
    }

    private function getWeeklyTimetable()
    {
        if (!$this->class_id) return collect();

        return Timetable::where('class_id', $this->class_id)
            ->with(['class:id,name', 'subject:id,name', 'staff:id,firstname'])
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();
    }

    public function save()
    {
        $this->resetErrorBag();

        $this->validate([
            'class_id' => 'required|exists:mysql2.classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'staff_id' => 'required|exists:mysql2.staff,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Check for class time conflict first
        $classConflict = Timetable::where('class_id', $this->class_id)
            ->where('day', $this->day)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                      ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                      ->orWhere(function ($q) {
                          $q->where('start_time', '<=', $this->start_time)
                            ->where('end_time', '>=', $this->end_time);
                      });
            })
            ->when($this->timetable_id, fn($q) => $q->where('id', '!=', $this->timetable_id))
            ->exists();

        if ($classConflict) {
            $this->addError('class_id', 'Time Conflict: Overlaps with another subject for the same class.');
            return;
        }

        // Check for staff conflict
        $staffConflict = Timetable::where('staff_id', $this->staff_id)
            ->where('day', $this->day)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                      ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                      ->orWhere(function ($q) {
                          $q->where('start_time', '<=', $this->start_time)
                            ->where('end_time', '>=', $this->end_time);
                      });
            })
            ->when($this->timetable_id, fn($q) => $q->where('id', '!=', $this->timetable_id))
            ->exists();

        if ($staffConflict) {
            $this->addError('staff_id', 'Staff Conflict: Staff is already assigned at this time.');
            return;
        }

        // Save record
        Timetable::updateOrCreate(
            ['id' => $this->timetable_id],
            [
                'class_id' => $this->class_id,
                'subject_id' => $this->subject_id,
                'staff_id' => $this->staff_id,
                'day' => $this->day,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
            ]
        );

        session()->flash('success', 'Timetable saved successfully.');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'timetable_id',
            'class_id',
            'subject_id',
            'staff_id',
            'day',
            'start_time',
            'end_time',
        ]);
    }

    
    private function checkTimeConflict()
    {
        return Timetable::where('class_id', $this->class_id)
            ->where('day', $this->day)
            ->when($this->editId, fn ($q) => $q->where('id', '!=', $this->editId))
            ->where(function ($q) {
                $q->where('start_time', '<', $this->end_time)
                  ->where('end_time', '>', $this->start_time);
            })->exists();
    }

    private function checkStaffConflict()
    {
        return Timetable::where('staff_id', $this->staff_id)
            ->where('day', $this->day)
            ->when($this->editId, fn ($q) => $q->where('id', '!=', $this->editId))
            ->where('start_time', '<', $this->end_time)
            ->where('end_time', '>', $this->start_time)
            ->exists();
    }

    public function edit($id)
    {
        $t = Timetable::findOrFail($id);
        $this->fill($t->toArray());
        $this->editId = $t->id;
    }

    public function delete($id)
    {
        Timetable::findOrFail($id)->delete();
        session()->flash('success', 'Deleted successfully!');
        $this->dispatch('refreshTimetable');
    }

    public function bulkDelete()
    {
        if (!$this->selectedIds) {
            session()->flash('error', 'No entries selected.');
            return;
        }

        Timetable::whereIn('id', $this->selectedIds)->delete();
        session()->flash('success', count($this->selectedIds) . ' entries deleted!');
        $this->selectedIds = [];
        $this->selectAll = false;
        $this->dispatch('refreshTimetable');
    }

    public function duplicate($id)
    {
        $t = Timetable::findOrFail($id);
        $this->fill($t->toArray());
        $this->editId = null;
        session()->flash('info', 'Loaded for duplication. Edit and save.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new TimetableExport($this->class_id, $this->day),
            'timetable_' . now()->format('Y_m_d_H_i_s') . '.xlsx'
        );
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortBy === $field) ? ($this->sortDirection === 'asc' ? 'desc' : 'asc') : 'asc';
        $this->sortBy = $field;
        $this->resetPage();
    }

    public function resetInput()
    {
        $this->reset(['class_id', 'subject_id', 'staff_id', 'day', 'start_time', 'end_time', 'editId']);
    }

    public function resetFilters()
    {
        $this->reset(['class_id', 'day', 'search']);
        $this->resetPage();
    }

    public function toggleWeeklyView()
    {
        $this->showWeeklyView = !$this->showWeeklyView;
    }

    public function quickAdd($day, $periods)
    {
        if (!$this->class_id || !$this->subject_id) {
            session()->flash('error', 'Select class and subject first.');
            return;
        }

        $created = 0;
        foreach ($periods as $period) {
            $this->start_time = $period['start_time'];
            $this->end_time = $period['end_time'];
            $this->day = $day;

            if (!$this->checkTimeConflict()) {
                Timetable::create([
                    'class_id' => $this->class_id,
                    'subject_id' => $this->subject_id,
                    'staff_id' => $this->staff_id,
                    'day' => $this->day,
                    'start_time' => $this->start_time,
                    'end_time' => $this->end_time,
                ]);
                $created++;
            }
        }

        session()->flash('success', "$created periods added!");
        $this->dispatch('refreshTimetable');
    }
}
