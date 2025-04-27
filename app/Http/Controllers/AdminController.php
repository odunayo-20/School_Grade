<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {

        $student = Student::count();
        $subject = Subject::count();
        $class = StudentClass::count();

        return view('admin.index', compact(['student', 'subject', 'class']));
    }


    public function profile()
    {
        // $admin = Admin::get();
        return view('admin.Profile.index');
    }
    // public function profileEdit(Request $request, $id)
    // {
    //     // dd($id);
    //     $admin = Admin::findOrFail($id);
    //     $admin->name = $request->name;
    //     $admin->email = $request->email;
    //     // $admin->name = $request->name;

    //     $request->validate([
    //         'image' => 'nullable|mimes:png,jpg',
    //     ]);

    //     return redirect()->back();

    // }


    public function profileEdit(Request $request, $id)
    {
        // dd($id);

        if ($request->filled(['first_name', 'last_name', 'email', 'phone'])) {
            $request->validate([
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'phone' => 'required|min:3',
                'email' => 'required|email|min:3'
            ]);
        }
        $user = Admin::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled(['image'])) {
            $request->validate([

                'image' => 'max:300|mimes:jpg, png, jpeg',
            ]);
        }
        if ($request->hasFile('image')) {
            //  $image_path ="images/user/".$user->image;
            //  if (file_exists($image_path)){
            //      unlink($image_path);
            //  }
            $existingImagePath = public_path("images/user/{$user->image}");
            if (file_exists($existingImagePath) && is_file($existingImagePath)) {
                unlink($existingImagePath);
            }

            $imageName = request()->image->getClientOriginalName();
            request()->image->move(public_path('images/user/'), $imageName);
            $user->image = $imageName;
        }

        if ($request->filled(['current_password', 'new_password', 'confirm_password'])) {
            // Validate password change fields
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:5|different:current_password',
                'confirm_password' => 'required|same:new_password',
            ]);

            // Verify if the entered current password matches the actual password
            if (Hash::check($request->current_password, $user->password)) {
                // Check if the new and confirm passwords match
                if ($request->new_password !== $request->confirm_password) {
                    return redirect()->back()->with('error', 'New and confirm passwords do not match');
                }

                // Hash and update the new password
                $user->password = Hash::make($request->new_password);
            } else {
                return redirect()->back()->with('error', 'Incorrect current password');
            }
        }


        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }


}
