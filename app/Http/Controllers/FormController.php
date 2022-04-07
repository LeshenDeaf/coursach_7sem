<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->where('user_id', auth()->id())->get();

        if ($forms->isEmpty()) {
            return view('home.forms.create');
        }

        return view('home.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('home.forms.create');
    }

    public function edit(int $id)
    {
        $form = Form::with('fields')->findOrFail($id);

        return view('home.forms.edit', compact('form'));
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

        return redirect(
            route('home.forms.index')
        )->with('success', 'Form ' . $form->name . ' created');
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'fields' => ['required', 'max:255', 'array'],
            'fields.*' => ['integer']
        ]);

        $form->update([
            'name' => $request->input('name'),
        ]);

        $form->fields()->sync($request->input('fields'));

        return redirect(
            route('home.forms.index')
        )->with('success', 'Form ' . $form->name . ' edited');
    }

    public function destroy(int $id)
    {
        $form = Form::with('fields')->findOrFail($id);

        $form->fields()->detach();

        $form->delete();

        return redirect(route('home.forms.index'));
    }
}
