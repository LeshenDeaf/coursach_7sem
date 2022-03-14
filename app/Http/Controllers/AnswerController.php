<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Form;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = auth()->user()->answers;

        $grouped = [];

        foreach ($answers as $answer) {
            $grouped[date('d.m.Y', strtotime($answer->created_at))][] = $answer;
        }

        return view('home.answers.index', compact('answers', 'grouped'));
    }

    public function create()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function createFromForm(int $formId)
    {
        $form = Form::with('fields')->findOrFail($formId);

        return view('home.answers.create', compact('form'));
    }

    public function store(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $formId
     */
    public function storeFromForm(Request $request, int $formId)
    {
        $form = Form::with('fields')->findOrFail($formId);
        $fields = $form->fields;

        foreach ($fields as $field) {
            if (!$request->input($field->name)) {
                return back()->with('error', $field->label . ' is not filled');
            }
            Answer::create([
                'answer' => $request->input($field->name),
                'field_id' => $field->id,
            ]);
        }

        return redirect(route('home.answers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
