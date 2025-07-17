<?php

namespace App\Http\Controllers\Admin;

use App\Models\Circular;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SchoolSession;
use App\Models\Semester;
use App\Models\StudentClass;
use Illuminate\Support\Facades\Storage;

class CircularController extends Controller
{
    public function index()
    {
        $circulars = Circular::latest()->paginate(10);
        return view('admin.circulars.index', compact('circulars'));
    }

    public function create()
    {
        $classes = StudentClass::where('status', 0)->get();
        $sessions = SchoolSession::where('status', 0)->get();
        $semesters = Semester::where('status', 0)->get();
        return view('admin.circulars.create', compact(['sessions', 'semesters', 'classes']));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'schoolsession_id' => 'required',
            'semester_id' => 'required',
            'title' => 'required|string|max:255',
            'circular_date' => 'required|date',
            'attachment' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $request->file('attachment')->store('circulars', 'public');
            $file = $validated['attachment_path'];
        }

        Circular::create([
            'schoolsession_id' => $request->schoolsession_id,
            'semester_id' => $request->semester_id,
            'title' =>  $request->title,
            'message' => $request->message,
            'circular_date' => $request->circular_date,
            'attachment_path' => $file ?? '',
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect()->route('admin.circular')->with('success', 'Circular created successfully!');
    }

    public function show($circular)
    {
        $circular = Circular::findOrFail($circular);
        return view('admin.circulars.show', compact('circular'));
    }

    public function destroy(Circular $circular)
    {
        if ($circular->attachment_path) {
            Storage::delete($circular->attachment_path);
        }

        $circular->delete();
        return back()->with('success', 'Circular deleted.');
    }
}
