<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function login()
    public function login()
    {
        return view('admin.Auth.login');
    }


    public function loginConfirm(Request $request)
    {
        // dd("klmkmdmf");
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // dd($validated);
        // Auth::login()

        // if(Auth::guard('admin')->Auth::attempt(['email' => $email, 'password' => $password]))
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect(route('admin.dashboard'));
        } else {
            session()->flash('error', 'Invalid Credentials');
            return redirect(route('admin.login'));
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
