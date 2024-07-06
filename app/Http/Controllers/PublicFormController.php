<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class PublicFormController extends Controller
{
    public function show(Form $form)
    {
        return view('public.form', compact('form'));
    }

    public function submit(Request $request, Form $form)
    {
        $data = $request->except('_token');
        $form->submissions()->create(['data' => $data]);

        return redirect()->back()->with('success', 'Form submitted successfully');
    }
}