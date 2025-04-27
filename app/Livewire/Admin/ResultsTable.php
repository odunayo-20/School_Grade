<?php

namespace App\Livewire\Admin;

use App\Models\Grade;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;

class ResultsTable extends Component
{

    public $student_id, $subject_id, $marks;

    public function saveResult()
    {
        $this->validate([
            'student_id' => 'required',
            'subject_id' => 'required',
            'marks' => 'required|integer|min:0|max:100',
        ]);

        $grade = Grade::getGrade($this->marks);

        Result::create([
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'marks' => $this->marks,
        ]);

        session()->flash('message', 'Result saved successfully. Grade: ' . $grade->grade);

        $this->reset(['student_id', 'subject_id', 'marks']);
    }

    public function render()
    {
        return view('livewire.admin.results-table', [
            'students' => Student::all(),
            'subjects' => Subject::all(),
            'results' => Result::get(),
        ]);
    }
}
