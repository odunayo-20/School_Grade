<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use App\Models\ExternalEvent;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{

    use WithPagination;

    #[Url(history: true)]
    public $search = '';
    public $pagination = 10;

    public $eventsPublish = [];
    public $eventsDraft = [];
    public $event_id;
    public function mount()
    {
        $this->eventsPublish = ExternalEvent::where('status', 'published')->get();
        $this->eventsDraft = ExternalEvent::where('status', 'drafted')->get();
    }



    public function updateStatus($eventId, $newStatus)
    {
        $event = ExternalEvent::find($eventId);
        $event->update(['status' => $newStatus]);
    }



    public function delete($event_id)
    {

        $this->event_id = $event_id;
    }

    public function destroy()
    {
        $event =  ExternalEvent::findOrFail($this->event_id);
        $event->delete();
        if (Storage::disk('local')->exists($event->image)) {
            Storage::delete($event->image);
            $event->delete();
        }
        $this->dispatch('close-modal');
        session()->flash('success', 'Event is Successfully Deleted');
    }


    public function render()
    {
        if (!$this->search) {

            $events = ExternalEvent::latest()->paginate($this->pagination);
        } else {

            $events = ExternalEvent::latest()->where('title', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }
        return view('livewire.admin.event.index', compact('events'));
    }
}
