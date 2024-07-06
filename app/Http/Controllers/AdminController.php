<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class AdminController extends Controller
{
    public function dashboard()
    {
        $forms = Form::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('forms'));
    }
}
