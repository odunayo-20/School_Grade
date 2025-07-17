<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExternalEvent;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;


class EventController extends Controller
{
    public function index()
    {
        return view("admin.event.index");
    }

    public function create()
    {
        return view('admin.event.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'location' => 'required|string',
            'message' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'time' => 'required',
            'date' => 'required',
        ]);

        // Get uploaded file
        // $imageFile = $request->file('image');

        // // ✅ Resize using fluent API (downscale to max width 800px)
        // $resizedImage = ImageManager::gd()
        // ->read($imageFile)
        // ->resizeDown(800, 600) // for blog header
        // ->toJpeg(80);

        // // Create unique filename
        // $filename = time() . '_' . Str::slug($request->title) . '.jpg';
        // $path = 'events/' . $filename;

        // // Save resized image to storage
        // Storage::disk('public')->put($path, $resizedImage);


        $image = $request->image->store('events', 'public');
        // Save event
        ExternalEvent::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'location' => $request->location,
            'content' => $request->message,
            'time' => $request->time,
            'date' => $request->date,
            'image' => $image,
        ]);

        session()->flash('success', 'Event Successfully Created');
        return redirect(route('admin_event'));
    }



    public function edit($event)
    {
        $event = ExternalEvent::where('slug', $event)->first();
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, $event)
    {
        $event = ExternalEvent::where('slug', $event)->first();

        if (!empty($request->new_image)) {
            if (Storage::disk('public')->exists($request->old_image)) {
                Storage::disk('public')->delete($request->old_image);
            }
            $filePath = $request->new_image->store('events', 'public');
        } else {
            $filePath = $request->old_image;
        }

        $event->title = $request->title;
        $event->slug = Str::slug($request->title);
        $event->location = $request->location;
        $event->content = $request->message;
        $event->time = $request->time;
        $event->date = $request->date;
        $event->image = $filePath;
        $event->update();
        session()->flash('success', 'Event Successfully Updated');
        return redirect(route('admin_event'));

    }


    public function view($event)
    {
        $event = ExternalEvent::where('slug', $event)->first();
        return view('admin.event.view', compact('event'));
    }
}
