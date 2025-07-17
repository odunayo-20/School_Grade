<?php

namespace App\Livewire\Admin\Affective;

use App\Models\Affective;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Semester;
use App\Models\StudentClass;
use App\Models\SchoolSession;

class Index extends Component
{

public $students = [];
    public $classes;
    public $semesters;
    public $sessions;

    public $selectedClass = null;
    public $selectedSemester = null;
    public $selectedSession = null;
    public $marks = [];

    protected $rules = [
        'marks.*.*' => 'required|numeric|min:0|max:100',
    ];

    protected $messages = [
        'marks.*.*.required' => 'Mark is required for all fields.',
        'marks.*.*.numeric'  => 'Mark must be a number.',
        'marks.*.*.min'      => 'Mark cannot be less than 0.',
        'marks.*.*.max'      => 'Mark cannot exceed 100.',
    ];

    public function mount()
    {
        $this->classes = StudentClass::where('status', 0)->get();
        $this->semesters = Semester::where('status', 0)->get();
        $this->sessions = SchoolSession::where('status', 0)->get();
    }

    public function updatedSelectedClass()
    {
        $this->filterStudents();
    }

    public function updatedSelectedSemester()
    {
        $this->filterStudents();
    }

    public function filterStudents()
    {

        $this->validate([
            'selectedClass' => 'required',
            'selectedSession' => 'required',
            'selectedSemester' => 'required',
        ]);

        if ($this->selectedClass && $this->selectedSession) {
            $this->students = Student::where('current_class_id', $this->selectedClass)->where('schoolsession_id', $this->selectedSession)->get();
            $this->loadMarks();
        } else {
            $this->students = [];
            $this->marks = [];
        }
    }


    public function loadMarks()
{
    foreach ($this->students as $student) {
        foreach (['Punctuality', 'Perseverance', 'Responsibility', 'Diligence', 'Self Control', 'Neatness', 'Honesty', 'Reliability', 'Attendance', 'Initiative', 'Organization Ability', 'Attentiveness', 'Co-operativeness', 'Curiosity', 'Creativity'] as $type) {
            $existingMark = Affective::where([
                'student_id'  => $student->id,
                'semester_id' => $this->selectedSemester,
                'schoolSession_id' => $this->selectedSession,
                'type'        => $type,
            ])->first();

            $this->marks[$student->id][$type] = $existingMark ? $existingMark->marks : null;
        }
    }
}





    public function saveStudentMarks($studentId)
{
    $this->validate();

    if (!isset($this->marks[$studentId])) {
        session()->flash('error', 'No marks entered for this student.');
        return;
    }

    foreach ($this->marks[$studentId] as $type => $mark) {
        Affective::updateOrCreate(
            [
                'student_id'  => $studentId,
                'semester_id' => $this->selectedSemester,
                'schoolsession_id' => $this->selectedSession,
                'type'        => $type,
            ],
            ['marks' => $mark]
        );
    }

    session()->flash('success', 'Marks saved successfully!');
}


    public function saveAllMarks()
    {
        $this->validate();

        foreach ($this->students as $student) {
            $this->saveStudentMarks($student->id);
        }

        session()->flash('success', 'All marks saved successfully!');
    }

    public function resetFields()
    {
        $this->selectedClass = null;
        $this->selectedSemester = null;
        $this->selectedSession = null;
        $this->students = [];
        $this->marks = [];
    }

    public function render()
    {
        return view('livewire.admin.affective.index');
    }
}
