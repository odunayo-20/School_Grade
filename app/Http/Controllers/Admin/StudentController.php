<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Semester;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\SchoolSession;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(){

        $students = Student::get();
        return view('admin.student.index', compact('students'));
    }
    public function create(){
        $classes  = StudentClass::where('status', '0')->orderBy('name')->get();
        $schoolSessions  = SchoolSession::where('status', '0')->orderByDesc('name')->get();

        return view('admin.student.create', compact(['classes', 'schoolSessions']));
    }
    public function store(Request $request){
$validated = $request->validate([
    'first_name' => 'required|min:2',
    'last_name' => 'required|min:2',
    'other_name' => 'nullable|min:2',
    'email' => 'required|min:2|unique:students,email',
    'register_number' => 'required|min:2',
    'phone' => 'required|min:2|numeric',
    'class_id' => 'required',
    'schoolSession_id' => 'required',
    'status' => 'nullable',
]);

// Student::create($validated);

$student = Student::create([
   'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'other_name' => $request->other_name,
    'email' => $request->email,
    'register_number' => $request->register_number,
    'phone' => $request->phone,
    'class_id' => $request->class_id,
    'schoolSession_id' => $request->schoolSession_id,
    'phone' => $request->phone,
    'status'=> $request->status == true ? 1 : 0
]);
session()->flash('success', 'Student Successfully Created');
return redirect(route('admin.student'));
    }

    public function edit($id){
        $student = Student::findOrFail($id);
        $classes  = StudentClass::where('status', '0')->orderBy('name')->get();
        $schoolSessions  = SchoolSession::where('status', '0')->orderByDesc('name')->get();


        return view('admin.student.edit', compact(['student', 'classes', 'schoolSessions']));
    }

    public function update(Request $request, $id){

        // $validated = $request->validate([
        //     'first_name' => 'required|min:2',
        //     'last_name' => 'required|min:2',
        //     'other_name' => 'nullable|min:2',
        //     'email' => 'required|min:2',
        //     'register_number' => 'required|min:2',
        //     'phone' => 'required|min:2|numeric',
        //     'class_id' => 'required',
        //     'schoolSession_id' => 'required',
        // ]);
$student = Student::findOrFail($id);
$student->first_name = $request->first_name;
$student->last_name = $request->last_name;
$student->other_name = $request->other_name;
$student->email = $request->email;
$student->register_number = $request->register_number;
$student->phone = $request->phone;
$student->class_id = $request->class;
$student->schoolSession_id = $request->schoolSession_id;
$student->phone = $request->phone;
$student->status= $request->status == true ? 1 : 0;
$student->update();
session()->flash('success', "Student Successfully Created");
return redirect(route('admin.student'));
    }

    public function destroy($id){
// dd($id);
$student = Student::findOrFail($id);
if($student){

    $student->delete();
    session()->flash("success", "Student Record Successfully Deleted");
    return redirect()->back();

}else{
    session()->flash("error", "Student Record not Found");

    return redirect()->back();
}
    }

}
