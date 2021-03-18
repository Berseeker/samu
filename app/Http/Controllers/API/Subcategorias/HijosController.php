<?php

namespace App\Http\Controllers\API\Subcategorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Subcate_hijos;
use App\Models\Subcategoria;

class HijosController extends Controller
{
    public function index()
    {
        $subcategorias = Subcate_hijos::all();
        $message = 'Se encontraron '.count($subcategorias).' subcategorias (hijas) registradas';
        $data = null;
        if(!$subcategorias->isEmpty())    
            $data = $subcategorias;
        
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => 200
        ],200);
    }

    public function show($id)
    {
        $subcategoria = Subcate_hijos::with('subcategoria')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Mostrando la subcategoria (hija) solicitada',
            'data' => $subcategoria,
            'code' => 200
        ],200);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'subcategoria_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Por favor asigna un nombre a la categoria que se creará',
            'subcategoria_id' => 'Por favor asigna una subcategoria'
        ];

        $this->validate($request,$rules,$messages);

        $subcategoria = Subcategoria::findOrFail($request->subcategoria_id);

        $hijo = new Subcate_hijos();
        $hijo->nombre = Str::of(Str::of($request->nombre)->lower())->title();
        $hijo->subcategoria_id = $subcategoria->id;
        $hijo->tag = Str::slug(Str::of($request->nombre)->lower());
        $hijo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La subcategoria (hijo) se creo exitosamente',
            'data' => $hijo,
            'code' => 200
        ],200); 
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required',
            'subcategoria_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Por favor asigna un nombre a la categoria que se creará',
            'subcategoria_id' => 'Por favor asigna una subcategoria'
        ];

        $this->validate($request,$rules,$messages);

        $subcategoria = Subcategoria::findOrFail($request->subcategoria_id);

        $hijo = Subcate_hijos::findOrFail($id);
        $hijo->nombre = Str::of(Str::of($request->nombre)->lower())->title();
        $hijo->subcategoria_id = $subcategoria->id;
        $hijo->tag = Str::slug(Str::of($request->nombre)->lower());
        $hijo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La subcategoria se actualizó exitosamente',
            'data' => $hijo,
            'code' => 200
        ],200); 
    }

    public function delete($id)
    {
        $hijo = Subcate_hijos::findOrFail($id);
        $productos = Producto::where('subcategoria_id',$hijo->id)->get();

        $data = null;
        $message = 'No se puede borrar la subcategoria porque todavia hay productos que dependen de ella';
        $status = 'error';
        $code = 406;
        if($productos->isEmpty())
        {
            $hijo->delete();
            $message = 'La subcategoria se elimino correctamente';
            $code = 200;
            $status = 'success';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ],$code);
    }
}
