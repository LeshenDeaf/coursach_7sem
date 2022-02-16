<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->get();

        return view('home.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('home.forms.create');
    }
}
