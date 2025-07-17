<?php

namespace App\Livewire\Admin\News;

use App\Models\ExternalNews;
use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{

    public $news_id;

    use WithPagination;

    #[Url(history:true)]
    public $search = '';
    public $pagination = 10;

    public $newsPublish = [];

    public $newsDraft = [];
#[On('status-updated')]
    public function mount()
    {
        $this->newsPublish = ExternalNews::where('status', '0')->get();
        $this->newsDraft = ExternalNews::where('status', '1')->get();
    }


    public function updateStatus($newsId, $newStatus)
    {
        $news = ExternalNews::find($newsId);
        $news->update(['status' => $newStatus]);
        $this->dispatch('status-updated');
    }




    public function delete($news_id){

        $this->news_id = $news_id;
    }

    public function destroy(){
        $news =  ExternalNews::findOrFail($this->news_id);
        $news->delete();
        if(Storage::disk('local')->exists($news->image)){
            Storage::delete($news->image);
            $news->delete();
        }
        $this->dispatch('close-modal');
        session()->flash('success', 'News is Successfully Deleted');
    }


    public function render()
    {
        if (!$this->search) {

            $news = ExternalNews::latest()->paginate($this->pagination);
        } else {

            $news = ExternalNews::latest()->where('title', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        }

        return view('livewire.admin.news.index', compact('news'));
    }
}
