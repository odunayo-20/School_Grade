<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function index()
    {

        $results = Result::get();
        return view('admin.result.index', compact('results'));
    }
    public function create()
    {
        return view('admin.result.create');
    }
    public function store(Request $request)
    {
        // dd('fdlnkfkndf');
        $validated = $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'other_name' => 'nullable|min:2',
            'email' => 'required|min:2|unique:results,email',
            'register_number' => 'required|min:2',
            'phone' => 'required|min:2|numeric',
            'class' => 'required|min:2',
            'phone' => 'required|min:2',
            'status' => 'nullable',
        ]);

        // result::create($validated);

        $result = Result::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'other_name' => $request->other_name,
            'email' => $request->email,
            'register_number' => $request->register_number,
            'phone' => $request->phone,
            'class' => $request->class,
            'phone' => $request->phone,
            'status' => $request->status == true ? 1 : 0
        ]);
        session()->flash('success', 'Result Successfully Created');
        return redirect(route('admin.result'));
    }

    public function edit($id)
    {
        $result = Result::findOrFail($id);
        return view('admin.result.edit', compact('result'));
    }

    public function update(Request $request, $id)
    {
        // dd($id);

        $result = Result::findOrFail($id);
        $result->first_name = $request->first_name;
        $result->last_name = $request->last_name;
        $result->other_name = $request->other_name;
        $result->email = $request->email;
        $result->register_number = $request->register_number;
        $result->phone = $request->phone;
        $result->class = $request->class;
        $result->phone = $request->phone;
        $result->status = $request->status == true ? 1 : 0;
        $result->update();
        session()->flash('success', "Result Successfully Created");
        return redirect(route('admin.result'));
    }

    public function destroy($id)
    {
        // dd($id);
        $result = Result::findOrFail($id);
        if ($result) {

            $result->delete();
            session()->flash("success", "Result Record Successfully Deleted");
            return redirect()->back();
        } else {
            session()->flash("error", "Result Record not Found");

            return redirect()->back();
        }
    }
}
