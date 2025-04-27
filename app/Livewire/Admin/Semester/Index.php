<?php

namespace App\Livewire\Admin\Semester;

use Livewire\Component;
use App\Models\Semester;
use Illuminate\Support\Str;

class Index extends Component
{

    public $name, $slug,$status, $semester;



    public function storeSemester()
    {
        $this->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        Semester::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1': '0',
        ]);

        session()->flash('success', 'Semester Successfully Created');
        $this->reset();

        $this->dispatch('close-modal');
    }

    public function editSemester(Semester $semester)
    {

        $this->semester = $semester;
        $this->name = $semester->name;
        $this->slug = $semester->slug;
        $this->status = $semester->status == '1' ? true : false;

    }



    public function updateSemester()
    {
        $this->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);
        // dd($this->semester);

        $this->semester->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
        ]);

        session()->flash('success', 'Semester Successfully Updated');
        $this->reset();
        $this->dispatch('close-modal');
    }

    public function deleteSemester($semester)
    {
        // dd($semester);
        $this->semester = $semester;
    }
    public function destroySemester()
    {
        Semester::findOrFail($this->semester)->delete();
        session()->flash('success', 'Semester Successfully Deleted');
        $this->reset();
        $this->dispatch('close-modal');
    }


    public function render()
    {
        $semesters = Semester::orderBy('name')->get();
        return view('livewire.admin.semester.index',  compact('semesters'))->extends('layouts.auth-layout')->section('content');
    }
}
