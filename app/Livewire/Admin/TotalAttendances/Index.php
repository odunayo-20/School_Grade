<?php

namespace App\Livewire\Admin\TotalAttendances;

use App\Models\SchoolSession;
use App\Models\Semester;
use App\Models\TotalAttendance;
use Livewire\Component;

class Index extends Component
{

    public $session_id, $total, $semester, $status, $TotalAttendance;



public function storeTotalAttendance(){
    $this->validate([
        'semester' => 'required|integer',
        'session_id' => 'required|numeric',
        'total' => 'required|numeric',
    ]);

    TotalAttendance::create([
        'student_id' => 1,
        'semester_id' => $this->semester,
        'schoolsession_id' => $this->session_id,
        'total' => $this->total,
        'status' => $this->status == true ? '1': '0',
    ]);

    session()->flash('success', 'TotalAttendance Successfully Created');
    $this->reset();

    $this->dispatch('close-modal');
}

public function editTotalAttendance(TotalAttendance $TotalAttendance){

    $this->TotalAttendance = $TotalAttendance;
$this->semester = $TotalAttendance->semester_id;
$this->session_id = $TotalAttendance->schoolsession_id;
$this->total = $TotalAttendance->total;
$this->status = $TotalAttendance->status == '1' ? true : false;
}



public function updateTotalAttendance(){
    $this->validate([
        'semester' => 'required',
        'session_id' => 'required|numeric',
        'total' => 'required|numeric',
    ]);

    $this->TotalAttendance->update([
        'student_id' => 1,
        'semester_id' => $this->semester,
        'schoolsession_id' => $this->session_id,
        'total' => $this->total,
        'status' => $this->status == true ? '1' : '0',
    ]);
    session()->flash('success', value: 'TotalAttendance Successfully Updated');
    $this->reset();
    $this->dispatch('close-modal');

}

public function deleteTotalAttendance($TotalAttendance){
    $this->TotalAttendance = $TotalAttendance;
}
public function destroyTotalAttendance(){
    TotalAttendance::findOrFail($this->TotalAttendance)->delete();
    session()->flash('success', value: 'TotalAttendance Successfully Deleted');
    $this->dispatch('close-modal');
}


    public function render()
    {
$sessions = SchoolSession::where('status', 0)->get();
$semesters = Semester::where('status', 0)->get();
        $total_attendances = TotalAttendance::get();
        return view('livewire.admin.total-attendances.index',compact(['total_attendances', 'sessions', 'semesters']))->extends('layouts.auth-layout')->section('content');
    }
}
