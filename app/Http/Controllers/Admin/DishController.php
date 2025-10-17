<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    public function index()
    {
        return view('admin.Dish.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'presio' => 'required',
            'tipo' => 'required',

        ]);

        try {
            $validator->validate();
            Dish::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'presio' => $request->presio,
                'tipo' => $request->tipo,
                
            ]);
            return redirect()->route('admin.dish.index')
                ->with('success', ' el plato fue registrado correctamente. ');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'presio' => 'required',
            'tipo' => 'required',
        ]);

        try {
            $validator->validate();

            $dish = Dish::findOrFail($id);
            Dish::update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'presio' => $request->presio,
                'tipo' => $request->tipo,
            ]);
            return redirect()->route('admin.dish.index')
                ->with('success', ' el plato fue actualizado correctamente. ');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }
    public function destroy(string $id)
    {
        Dish::find($id)->delete();
        return redirect()->route('admin.dish.index')->with('success', 'El palto fue eliminado correctamente.');
    }
}
