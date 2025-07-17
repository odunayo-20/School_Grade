<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalNews;

class NewsController extends Controller
{
    public function index(){
        return view("admin.news.index");
    }

    public function create(){
        return view('admin.news.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());

        // $validated = $request->validate([
        //     'title' => 'required|string',
        //     'subtitle' => 'required|string',
        //     'summary' => 'required|string',
        //     'location' => 'required|string',
        //     'content' => 'required|string',
        //     // 'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        //     'time' => 'required',
        //     'date' => 'required',
        // ]);



        $image = $request->image->store('news', 'public');
        // Save event
        ExternalNews::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'summary' => $request->summary,
            'slug' => Str::slug($request->title),
            // 'location' => $request->location,
            'content' => $request->content,
            'time' => $request->time,
            'date' => $request->date,
            'image' => $image,
        ]);

        session()->flash('success', 'News Successfully Created');
        return redirect(route('admin_news'));
    }






    public function view($slug)
    {
        $news = ExternalNews::where('slug', $slug)->first();
        return view('admin.news.view', compact('news'));
    }
}


