<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        $forms = Form::orderBy('created_at', 'desc')->get();
        return view('forms.index', compact('forms'));
    }
    public function create()
    {
        return view('forms.create');
    }

    public function store(Request $request)
    {
        $form = Form::create($request->only('name'));

        if ($request->has('fields')) {
            foreach ($request->fields as $index => $fieldData) {
                $form->fields()->create([
                    'label' => $fieldData['label'],
                    'type' => $fieldData['type'],
                    'options' => $fieldData['type'] === 'select' ? $fieldData['options'] : null,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }

    public function edit(Form $form)
    {
        return view('forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $form->update($request->only('name'));

        // Delete existing fields
        $form->fields()->delete();

        // Create new fields
        if ($request->has('fields')) {
            foreach ($request->fields as $index => $fieldData) {
                $form->fields()->create([
                    'label' => $fieldData['label'],
                    'type' => $fieldData['type'],
                    'options' => $fieldData['type'] === 'select' ? $fieldData['options'] : null,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index')->with('success', 'Form deleted successfully.');
    }
 

   
}