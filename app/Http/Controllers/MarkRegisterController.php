<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkRegisterController extends Controller
{
    public function index(){
        return view('admin.mark-register.index');
    }
    public function result_view(){
        return view('admin.mark-register.view-result');
    }

    public function affective(){
        return view('admin.affective.index');
    }
    public function pyschomotor(){
        return view('admin.pyschomotor.index');
    }
    public function attendance(){
        return view('admin.attendance.index');
    }
}
