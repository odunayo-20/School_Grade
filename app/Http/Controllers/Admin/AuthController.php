<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Mail\WebsiteMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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


    public function forget()
    {
        return view('admin.Auth.forget');
    }


    public function forgetSend(Request $request)
    {
        $validated = $request->validate(['email' => 'required|email']);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            session()->flash('error', 'Email not found');
            return redirect(route('admin.forget'));
        }

        $token = Hash('sha256', time());
        $admin->token = $token;
        $admin->update();
        $reset_link = url('reset-password/' . $token . '/' . $request->email);
        $subject = "Reset Your Password";
        $message = 'Please Click On Below To Reset Your Password';
        $maildata = [
            'title' => 'Password Reset',
            'url' => $reset_link,
            'message' => $message,
        ];
        Mail::to($request->email)->send(new WebsiteMail($subject, $maildata));

        session()->flash('success', 'Reset Password Link sent to your email');
        return redirect(route('admin.forget'));
    }



    public function resetPassword(Request $request, $token, $email)
    {
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if (! $admin) {
            session()->flash('error', 'Invalid Email Or Token');

            return redirect(route('admin.login'));
        } else {
            $admin = Admin::where('email', $email)->where('token', $token)->first();
            return view('admin.Auth.reset', compact('admin'));
            // return redirect(route('admin.resetPassword', compact('admin')));
        }
    }



    public function resetPasswordChange(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string',
            'password' => 'required|same:password',
        ]);

        $admin = Admin::where('email', $request->email)->where('token', $request->token)->first();
        $admin->password = Hash::make($request->password);
        $admin->token = ' ';
        $admin->update();
        session()->flash('success', 'Password Reset Successfully');

        return redirect(route('admin.login'));
    }
}
