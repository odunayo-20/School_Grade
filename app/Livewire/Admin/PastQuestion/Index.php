<?php

namespace App\Livewire\Admin\PastQuestion;

use App\Models\Subject;
use Livewire\Component;
use App\Models\Semester;
use App\Models\PastQuestion;
use App\Models\StudentClass;
use App\Models\SchoolSession;
use Livewire\WithFileUploads;
use App\Models\ExternalAssignSubject;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{


    public $title, $subject_id, $class_id, $term_id, $session_id, $file;
    public $classes = [], $subjects = [];
    public $pastQuestion;

    use WithFileUploads;

    public function mount()
    {
        $this->classes = StudentClass::all(); // Load all StudentClass
    }


    public function updatedClassId($value)
    {
        $class = StudentClass::with('subjects')->find($value);

        $this->subjects = $class ? $class->subjects : collect();
    }

    public function save()
    {

        $filePath = null;
        $this->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
            'term_id' => 'required',
            'session_id' => 'required',
            'file' => 'required|file|max:2048|mimes:pdf,docx,xsl,xlsx,txt,csv',
        ]);

        if ($this->file) {
            $filePath = $this->file->store('pastQuestions', 'public');
        }

        PastQuestion::create([
            'title' => $this->title,
            'subject_id' => $this->subject_id,
            'class_id' => $this->class_id,
            'term_id' => $this->term_id,
            'session_id' => $this->session_id,
            'file' => $filePath ?? '',
        ]);

        session()->flash('success', 'Past Question added successfully.');

        $this->reset(['title', 'subject_id', 'class_id', 'term_id', 'session_id', 'file']);
        $this->dispatch('close-modal');
        $this->dispatch('question-added');
    }

    public function editPast(PastQuestion $pastQuestion)
    {

        $this->pastQuestion = $pastQuestion;
        $this->title = $pastQuestion->title;
        $this->subject_id = $pastQuestion->subject_id;
        $this->class_id = $pastQuestion->class_id;
        $this->term_id = $pastQuestion->term_id;
        $this->session_id = $pastQuestion->session_id;
    }

    public function updatePast()
    {
        $this->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
            'term_id' => 'required',
            'session_id' => 'required',
            'file' => 'nullable|file|max:2048|mimes:pdf,docx,xsl,xlsx,txt,csv',
        ]);

        if(!empty($this->file)){
            if (Storage::disk('public')->exists($this->pastQuestion->file)) {
                Storage::disk('public')->delete($this->pastQuestion->file);
            }
            $filePath = $this->file->store('pastQuestions', 'public');
        }else{
            $filePath = $this->pastQuestion->file;
        }
        $this->pastQuestion->update([
            'title' => $this->title,
            'subject_id' => $this->subject_id,
            'class_id' => $this->class_id,
            'term_id' => $this->term_id,
            'session_id' => $this->session_id,
            'file' => $filePath,
        ]);

        session()->flash('success', 'Past Question updated successfully.');

        $this->reset(['title', 'subject_id', 'class_id', 'term_id', 'session_id', 'file']);
        $this->dispatch('close-modal');
    }



    public function downloadPast($id)
    {
        $question = PastQuestion::findOrFail($id);

        // dd($question);

        // $filePath = $question->file

        if (!$question->file || !Storage::disk('public')->exists($question->file)) {
            session()->flash('error', 'File not found.');
            return;
        }
        return Storage::disk('public')->download($question->file);
        // Generate URL from storage



        // Dispatch browser event to trigger download
        $this->dispatch('download-past-question', ['url' => $url]);
    }



    public function deletePast($pastQuestion)
    {
        // dd($class);
        $this->pastQuestion = $pastQuestion;
    }
    public function destroyPast()
    {
        $pastQuestion = PastQuestion::findOrFail($this->pastQuestion);
        // Delete the actual file from storage
        if (Storage::disk('public')->exists($pastQuestion->file)) {
            Storage::disk('public')->delete($pastQuestion->file);
        }

        // Optionally delete the record from the DB
        $pastQuestion->delete();
        session()->flash('success', 'Past Question Successfully Deleted');
        $this->reset();
        $this->dispatch('close-modal');
    }



    public function render()
    {
        $pastQuestions = PastQuestion::get();
        $sessions = SchoolSession::get();
        $semesters = Semester::get();
        // $subjects = Subject::
        return view('livewire.admin.past-question.index', compact(['pastQuestions', 'semesters', 'sessions']))->extends('layouts.auth-layout')->section('content');
    }
}
