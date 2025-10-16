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
            'marca' => 'required',
            'modelo' => 'required',
            'anio' => 'required',
            'color' => 'required',
        ]);

        try {
            $validator->validate();
            Dish::create([
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'anio' => $request->anio,
                'color' => $request->color,
                
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
            'marca' => 'required',
            'modelo' => 'required',
            'anio' => 'required',
            'color' => 'required',
        ]);

        try {
            $validator->validate();

            $producto = Dish::findOrFail($id);
            Dish::update([
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'anio' => $request->anio,
                'color' => $request->color,
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
