<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    public function index()
    {
        return view('admin.Vehiculo.index');
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
            Vehiculo::create([
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'anio' => $request->anio,
                'color' => $request->color,
            ]);
            return redirect()->route('admin.vehiculo.index')
                ->with('success', ' el articulo fue registrado correctamente. ');
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

            $vehiculo = Vehiculo::findOrFail($id);
            Vehiculo::update([
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'anio' => $request->anio,
                'color' => $request->color,
            ]);
            return redirect()->route('admin.vehiculo.index')
                ->with('success', ' el vehiculo fue actualizado correctamente. ');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }
    public function destroy(string $id)
    {
        Vehiculo::find($id)->delete();
        return redirect()->route('admin.producto.index')->with('success', 'El vehiculo fue eliminado correctamente.');
    }
}
