<?php

namespace App\Livewire\Admin;

use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Semester;
use App\Models\Affective;
use App\Models\Attendance;
use App\Models\ExternalAssignSubject;
use App\Models\Resumption;
use App\Models\Pyschomotor;
use App\Models\StudentClass;
use App\Models\SchoolSession;
use App\Models\TotalAttendance;
use Barryvdh\DomPDF\Facade\Pdf;

class MarkResultView extends Component
{
    public $students = [];
    public $subjects = [];
    public $results = [];
    public $classes;
    public $semesters;
    public $sessions;

    public $selectedClass = null;
    public $selectedSemester = null;
    public $selectedSession = null;
    public $marks = [], $totals;

    public function mount()
    {
        $this->classes = StudentClass::all();
        $this->semesters = Semester::all();
        $this->sessions = SchoolSession::all();
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

            $this->totals = TotalAttendance::where('schoolsession_id', $this->selectedSession)->where('semester_id', $this->selectedSemester)->first();

            // $this->subjects = Subject::where('class_id', $this->selectedClass)->get();
            $this->subjects = ExternalAssignSubject::where('class_id', $this->selectedClass)->get();
            // Fetch results for all students in this class and semester
            // $studentIds = $this->students->pluck('id')->toArray();
            $this->results = Result::
                where('semester_id', $this->selectedSemester)->where('schoolsession_id', $this->selectedSession)
                ->get();

                $this->loadMarks();
        } else {
            $this->students = [];
            $this->sessions = [];
            $this->subjects = [];
            $this->results = [];
        }
    }

    public function calculateGrade($marks)
{
 if ($marks >= 70) {
        return 'A';
    } elseif ($marks >= 60) {
        return 'B';
    } elseif ($marks >= 50) {
        return 'C';
    } elseif ($marks >= 45) {
        return 'D';
    } elseif ($marks >= 40) {
        return 'E';
    }else {
        return 'F';
    }
}




public function determinePromotion($averagePercentage)
{
    return $averagePercentage >= 50 ? 'Promoted' : 'Not Promoted';
}


public function loadMarks()
{
    foreach ($this->students as $student) {
        foreach ($this->subjects as $subject) {
            foreach (['CA', 'Exam'] as $type) {
                $existingMark = Result::where([
                    'student_id'  => $student->id,
                    'subject_id'  => $subject->id,
                    'semester_id' => $this->selectedSemester,
                    'schoolsession_id' => $this->selectedSession,
                    'type'        => $type,
                ])->first();

                $this->marks[$student->id][$subject->id][$type] = $existingMark ? $existingMark->marks : null;
            }
        }
    }
}



public function calculateTotalMarks($studentId, $subjectId)
    {
        $classWork = $this->marks[$studentId][$subjectId]['Class Work'] ?? 0;
        $homeWork = $this->marks[$studentId][$subjectId]['Home Work'] ?? 0;
        $testWork = $this->marks[$studentId][$subjectId]['Test Work'] ?? 0;
        $exam = $this->marks[$studentId][$subjectId]['Exam'] ?? 0;

        return ($classWork * 0.1) + ($homeWork * 0.1) + ($testWork * 0.2) + ($exam * 0.6);
    }




    public function generatePDF($studentId)
    {
        $student = Student::findOrFail($studentId);


    //    $subjects = Subject::where('class_id', $student->class->id)->get();
       $subjects = ExternalAssignSubject::where('class_id', $this->selectedClass)->get();
        // Use Livewire properties
        $selectedClass = $this->selectedClass;
        $selectedSemester = $this->selectedSemester;
        $selectedSession = $this->selectedSession;

        if ($this->selectedClass && $this->selectedSession) {
            $this->totals = TotalAttendance::where('schoolsession_id', $this->selectedSession)->where('semester_id', $this->selectedSemester)->first();
            $total_attendances = Attendance::where('student_id', $studentId)->where('schoolsession_id', $this->selectedSession)->where('semester_id', $this->selectedSemester)->first();
        }
        // Fetch only relevant results
        $results = Result::where('student_id', $studentId)
            // ->where('schoolsession_id', $selectedSession)
            ->whereIn('subject_id', $subjects->pluck('id'))
            ->get();
        $affectives = Affective::where('student_id', $studentId)
            ->where('schoolsession_id', $selectedSession)
            ->where('semester_id', $selectedSemester)
            ->get();
        $pyschomotors = Pyschomotor::where('student_id', $studentId)
            ->where('schoolsession_id', $selectedSession)
            ->where('semester_id', $selectedSemester)
            ->get();
        $resumption = Resumption::latest()->where('schoolsession_id', $selectedSession)
            ->where('semester_id', $selectedSemester)
            ->first();
            $allStudents = Student::where('current_class_id', $student->class_id)
            ->where('schoolsession_id', $selectedSession)
            ->get();



        $data = [
            'resumption' => $resumption,
            'pyschomotors' => $pyschomotors,
            'affectives' => $affectives,
            'student' => $student,
            'subjects' => $subjects,
            'results' => $results,
            'selectedSemester' => $selectedSemester,
            'selectedSession' => $selectedSession,
            'total_attendances' => $total_attendances,
            'totals' => $this->totals,
            'allStudents' => $allStudents,
        ];

        $pdf = PDF::loadView('livewire.admin.student-result', $data);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            "{$student->first_name}_{$student->last_name}_Result.pdf"
        );
    }





    public function resetFields(){
        $this->reset();
    }

public function render()
{
    return view('livewire.admin.mark-result-view', [
        'calculateGrade' => function($marks) {
            return $this->calculateGrade($marks);
        }
    ]);
}

}
