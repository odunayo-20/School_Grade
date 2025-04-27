<?php

namespace App\Livewire\Admin\Class;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\StudentClass;

class Index extends Component
{

    public $name, $slug, $class, $status;



    public function storeClass()
    {
        $this->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        StudentClass::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
        ]);

        session()->flash('success', 'Class Successfully Created');
        $this->reset();

        $this->dispatch('close-modal');
    }

    public function editClass(StudentClass $class)
    {

        $this->class = $class;
        $this->name = $class->name;
        $this->slug = $class->slug;
        $this->status = $class->status == '1' ? true : false;

    }



    public function updateClass()
    {
        $this->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        $this->class->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',

        ]);
        session()->flash('success', value: 'Class Successfully Updated');
        $this->reset();
        $this->dispatch('close-modal');
    }

    public function deleteClass($class)
    {
        // dd($class);
        $this->class = $class;
    }
    public function destroyClass()
    {
        StudentClass::findOrFail($this->class)->delete();
        session()->flash('success', 'Class Successfully Deleted');
        $this->reset();
        $this->dispatch('close-modal');
    }


    public function render()
    {
        $classes = StudentClass::get();
        return view('livewire.admin.class.index', compact('classes'))->extends('layouts.auth-layout')->section('content');
    }
}
