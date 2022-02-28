<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\FieldResource;
use App\Models\Field;

class FieldController extends Controller
{
    public function index()
    {
        return FieldResource::collection(Field::all());
    }

    public function show($id)
    {
        return new FieldResource(Field::findOrFail($id));
    }
}
