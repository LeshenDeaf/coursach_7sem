<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    public function index()
    {
        return FieldResource::collection(Field::where('user_id', auth()->user()->id)->get());
    }

    public function show($id)
    {
        return new FieldResource(Field::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_name' => 'required',
            'type' => 'required',
        ]);

        return Field::create([
            'label' => $request->field_name,
            'type' => $request->type,
            'user_id' => $request->user()->id,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $field = Field::findOrFail($id);

        $field->update([
            'label' => $request->label,
            'type' => $request->type,
        ]);

        return $field;
    }

    public function destroy(int $id)
    {
        $field = Field::findOrFail($id);

        $field->delete();
    }
}
