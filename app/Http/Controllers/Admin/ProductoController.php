<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    public function index()
    {
        return view('admin.Product.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',

        ]);

        try {
            $validator->validate();
            Product::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
            ]);
            return redirect()->route('admin.producto.index')
                ->with('success', ' el articulo fue registrado correctamente. ');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',

        ]);

        try {
            $validator->validate();

            $producto = Product::findOrFail($id);
            Product::update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
            ]);
            return redirect()->route('admin.producto.index')
                ->with('success', ' el articulo fue actualizado correctamente. ');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.producto.index')->with('success', 'El producto fue eliminado correctamente.');
    }
}
