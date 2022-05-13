<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    public function index()
    {
        return FieldResource::collection(
            Field::where('user_id', auth()->user()->id)->get()
        );
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

        try {
            $field = Field::create([
                'label' => $request->input('field_name'),
                'type' => (int)$request->input('type'),
                'user_id' => $request->user()->id,
            ]);
        } catch (QueryException $e) {
            return response()->json(['error' => "Field must have unique both type and name"], 400);
        }

        $field->answers_count = 0;

        return $field;
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

        $field->forms()->detach();

        $field->delete();
    }
}
