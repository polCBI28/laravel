<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    public function index()
    {
        return view('admin.Article.index');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'contenido' => 'required',
            'estado_publicacion' => 'required',

        ]);

        try {
            $validator->validate();
            Article::create([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'estado_publicacion' => $request->estado_publicacion,
            ]);
            return redirect()->route('admin.Article.index')
                ->with('success', ' el articulo fue registrado correctamente. ');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo'=> 'required',
            'contenido' => 'required',
            'estado_publicacion' => 'required',

        ]);

        try {
            $validator->validate();

            $producto = Article::findOrFail($id);
            Article::update([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'estado_publicacion' => $request->estado_publicacion,
            ]);
            return redirect()->route('admin.Article.index')
                ->with('success', ' el articulo fue actualizado correctamente. ');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }
    public function destroy(string $id)
    {
        Article::find($id)->delete();
        return redirect()->route('admin.Article.index')->with('success', 'El producto fue eliminado correctamente.');
    }
}
