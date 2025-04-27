<?php

namespace App\Livewire\Admin\Resumption;

use App\Models\Resumption;
use App\Models\SchoolSession;
use App\Models\Semester;
use App\Models\Subject;
use Livewire\Component;

class Index extends Component
{


    public $session, $semester, $vacation_date, $resumption_date, $resumption;


    public function createResumption()
    {
        $this->validate([
            'session' => 'required|string',
            'semester' => 'required|string',
            'resumption_date' => 'required|date',
            'vacation_date' => 'required|date|after:resumption_date',
        ]);

        Resumption::create([
            'schoolsession_id' => $this->session,
            'semester_id' => $this->semester,
            'resumption_date' => $this->resumption_date,
            'vacation_date' => $this->vacation_date,
            // 'status' => $this->status == true ? '1': '0',
        ]);

        session()->flash('success', 'Resumption Successfully Created');
        $this->reset();
        $this->dispatch('close-modal');
    }

    public function editResumption(Resumption $resumption)
    {
        $this->resumption = $resumption;
        $this->session = $resumption->schoolsession_id;
        $this->semester = $resumption->semester_id;
        $this->vacation_date = $resumption->vacation_date;
        $this->resumption_date = $resumption->resumption_date;
    }



    public function updateResumption()
    {
        $this->validate([
            'session' => 'required|integer',
            'semester' => 'required|integer',
            'vacation_date' => 'required|string',
            'resumption_date' => 'required|string',
        ]);

        $this->resumption->update([
            'schoolsession_id' => $this->session,
            'semester_id' => $this->semester,
            'vacation_date' => $this->vacation_date,
            'resumption_date' => $this->resumption_date,
        ]);
        session()->flash('success', 'Resumption Successfully Updated');
        $this->reset();
        $this->dispatch('close-modal');
    }

    public function deleteResumption($resumption)
    {
        $this->resumption = $resumption;
    }

    public function destroyResumption()
    {
        Resumption::findOrFail($this->resumption)->delete();
        session()->flash('success', value: 'Resumption Successfully Deleted');
        $this->dispatch('close-modal');
    }

    public function mount() {}



    public function render()
    {
        $sessions = SchoolSession::get();
        $semesters = Semester::get();
        $resumptions = Resumption::get();
        return view('livewire.admin.resumption.index', compact(['sessions', 'semesters', 'resumptions']))->extends('layouts.auth-layout')->section('content');;
    }
}
