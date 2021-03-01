<?php

namespace App\Http\Controllers\API\Subcategorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Producto;

class SubcategoriaController extends Controller
{
    public function index()
    {
        $subcategorias = Subcategoria::all();
        $message = 'Se encontraron '.count($subcategorias).' subcategorias registradas';
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
        $subcategoria = Subcategoria::with('categoria')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Mostrando la subcategoria solicitada',
            'data' => $subcategoria,
            'code' => 200
        ],200);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'categoria_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Por favor asigna un nombre a la categoria que se creará',
            'categoria_id' => 'Por favor asigna una categoria'
        ];

        $this->validate($request,$rules,$messages);

        $categoria = Categoria::findOrFail($request->categoria_id);

        $subcategoria = new Subcategoria();
        $subcategoria->nombre = Str::of(Str::of($request->nombre)->lower())->title();
        $subcategoria->categoria_id = $categoria->id;
        $subcategoria->tag = Str::of($request->nombre)->lower();
        $subcategoria->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La subcategoria se creo exitosamente',
            'data' => $subcategoria,
            'code' => 200
        ],200); 
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required',
            'categoria_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Por favor asigna un nombre a la categoria que se creará',
            'categoria_id' => 'Por favor asigna una categoria'
        ];

        $this->validate($request,$rules,$messages);

        $categoria = Categoria::findOrFail($request->categoria_id);

        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->nombre = Str::of(Str::of($request->nombre)->lower())->title();
        $subcategoria->categoria_id = $categoria->id;
        $subcategoria->tag = Str::of($request->nombre)->lower();
        $subcategoria->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La subcategoria se actualizó exitosamente',
            'data' => $subcategoria,
            'code' => 200
        ],200); 
    }

    public function delete($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $productos = Producto::where('subcategoria_id',$subcategoria->id)->get();

        $data = null;
        $message = 'No se puede borrar la subcategoria porque todavia hay productos que dependen de ella';
        $status = 'error';
        $code = 406;
        if($productos->isEmpty())
        {
            $subcategoria->delete();
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
