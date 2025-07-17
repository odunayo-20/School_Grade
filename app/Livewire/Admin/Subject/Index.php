<?php

namespace App\Livewire\Admin\Subject;

use App\Models\StudentClass;
use App\Models\Subject;
use Livewire\Component;

class Index extends Component
{

    public $name, $code, $class, $status, $subject;
    // public $classes;
    // public $subjects = [];


public function storeSubject(){
    $this->validate([
        'name' => 'required|string',
        'code' => 'required|string',
    ]);

    Subject::create([
        'name' => $this->name,
        'code' => $this->code,
        'status' => $this->status == true ? '1': '0',
    ]);

    session()->flash('success', 'Subject Successfully Created');
    $this->reset();

    $this->dispatch('close-modal');
}

public function editSubject(Subject $subject){

    $this->subject = $subject;
$this->name = $subject->name;
$this->code = $subject->code;
$this->status = $subject->status == '1' ? true : false;
}



public function updateSubject(){
    $this->validate([
        'name' => 'required|string',
        'code' => 'required|string',
    ]);

    $this->subject->update([
        'name' => $this->name,
        'code' => $this->code,
        'status' => $this->status == true ? '1' : '0',
    ]);
    session()->flash('success', value: 'Subject Successfully Updated');
    $this->reset();
    $this->dispatch('close-modal');

}

public function deleteSubject($subject){
    $this->subject = $subject;
}
public function destroySubject(){
    Subject::findOrFail($this->subject)->delete();
    session()->flash('success', value: 'Subject Successfully Deleted');
    $this->dispatch('close-modal');
}


    public function render()
    {
        $classes = StudentClass::where('status', 0)->get();

        $subjects = Subject::get();
        return view('livewire.admin.subject.index', compact(['subjects', 'classes']))->extends('layouts.auth-layout')->section('content');
    }
}
