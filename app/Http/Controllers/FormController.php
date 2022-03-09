<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->get();

        if ($forms->isEmpty()) {
            return view('home.forms.create');
        }

        return view('home.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('home.forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'fields' => ['required', 'max:255', 'array'],
            'fields.*' => ['integer']
        ]);

        $form = Form::create([
            'name' => $request->input('name'),
            'user_id' => auth()->user()->id,
        ]);

        $form->fields()->sync(
            $request->input('fields')
        );

        return redirect(route('home.forms.index'));
    }
}
