<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalNews;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        return view("admin.news.index");
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif',
            'time' => 'required',
            'date' => 'required',
        ]);



        $image = $request->image->store('news', 'public');
        // Save event
        ExternalNews::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'summary' => $request->summary,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'time' => $request->time,
            'date' => $request->date,
            'image' => $image,
        ]);

        session()->flash('success', 'News Successfully Created');
        return redirect(route('admin_news'));
    }

    public function edit($news)
    {
        $news = ExternalNews::where('slug', $news)->first();
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $news)
    {


        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            'time' => 'required',
            'date' => 'required',
        ]);


        if (!empty($request->new_image)) {
            if (Storage::disk('public')->exists($request->old_image)) {
                Storage::disk('public')->delete($request->old_image);
            }
            $filePath = $request->new_image->store('news', 'public');
        } else {
            $filePath = $request->old_image;
        }

        $news = ExternalNews::where('slug', $news)->first();
        $news->title = $request->title;
        $news->subtitle = $request->subtitle;
        $news->summary = $request->summary;
        $news->slug = Str::slug($request->title);
        $news->content = $request->content;
        $news->time = $request->time;
        $news->date = $request->date;
        $news->image = $filePath;
        $news->update();
        session()->flash('success', 'News Successfully Updated');
        return redirect(route('admin_news'));
    }




    public function view($slug)
    {
        $news = ExternalNews::where('slug', $slug)->first();
        return view('admin.news.view', compact('news'));
    }
}
