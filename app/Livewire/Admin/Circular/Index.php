<?php

namespace App\Livewire\Admin\Circular;

use Livewire\Component;
use App\Models\Circular;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{

    public $circular;


    public function render()
    {
        $circulars = Circular::get();
        return view('livewire.admin.circular.index', compact('circulars'));
    }

    public function downloadPdf($circularId)
    {
        $circular = Circular::findOrFail($circularId);

        $pdf = Pdf::loadView('admin.pdf.circular', compact('circular'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'circular_' . $circular->id . '.pdf');
    }



    public function deleteCircular($circular)
    {
        // dd($class);
        $this->circular = $circular;
    }
    public function destroyCircular()
    {
        $circular = circular::findOrFail($this->circular);
        // Delete the actual file from storage
        if (Storage::disk('public')->exists($circular->attachment_path)) {
            Storage::disk('public')->delete($circular->attachment_path);
        }

        // Optionally delete the record from the DB
        $circular->delete();
        $this->dispatch('close-modal');
        session()->flash('success', 'Past Question Successfully Deleted');
    }


}
