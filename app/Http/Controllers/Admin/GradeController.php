<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GradeController extends Controller
{
public function index()
    {
        return view('admin.Grade.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'materia' => 'nullable|text',
            'calificacion' => 'required|decimal|min:0',
        ]);

        try {
            $validator->validate();

            Grade::create([
                'nombre' => $request->name,
                'materia' => $request->description,
                'calificacion' => $request->price,
            ]);

            return redirect()->route('admin.Grade.index')
                ->with('success', 'El Grade fue registrado correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|text',
            'price' => 'required|decimal|min:0',
        ]);

        try {
            $validator->validate();

            $Grade = Grade::findOrFail($id);
            Grade::update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            return redirect()->route('admin.Grade.index')
                ->with('success', 'El Grade fue actualizado correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function destroy(string $id)
    {
        Grade::find($id)->delete();
        return redirect()->route('admin.Grade.index')->with('success', 'El Grade fue eliminado correctamente.');
    }
}
