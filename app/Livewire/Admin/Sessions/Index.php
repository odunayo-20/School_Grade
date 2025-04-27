<?php

namespace App\Livewire\Admin\Sessions;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\SchoolSession;

class Index extends Component
{

    public $name, $slug,$status, $session;



    public function storeSession()
    {
        $this->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        SchoolSession::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1': '0',
        ]);

        session()->flash('success', 'Session Successfully Created');
        $this->reset();

        $this->dispatch('close-modal');
    }

    public function editSession(SchoolSession $session)
    {

        $this->session = $session;
        $this->name = $session->name;
        $this->slug = $session->slug;
        $this->status = $session->status == '1' ? true : false;

    }



    public function updateSession()
    {
        $this->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        $this->session->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
        ]);
        session()->flash('success', 'Session Successfully Updated');
        $this->reset();
        $this->dispatch('close-modal');
    }

    public function deleteSession($session)
    {
        // dd($session);
        $this->session = $session;
    }
    public function destroySession()
    {
        SchoolSession::findOrFail($this->session)->delete();
        session()->flash('success', 'Session Successfully Deleted');
        $this->reset();
        $this->dispatch('close-modal');
    }



    public function render()
    {
        $sessions = SchoolSession::get();
        return view('livewire.admin.sessions.index',  compact('sessions'))->extends('layouts.auth-layout')->section('content');
    }
}
