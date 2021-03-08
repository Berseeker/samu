<?php

namespace App\Http\Controllers\API\Subcategorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ChildImport;
use App\Imports\SubcategoriaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

use App\Models\File;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Producto;

class SubcategoriaController extends Controller
{
    public function index()
    {
        $subcategorias = Subcategoria::with('categoria')->where('child',null)->get();
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

    public function showChild($id)
    {
        $subcategoria = Subcategoria::with('categoria')->findOrFail($id);

        $hijos = Subcategoria::where('child',$subcategoria->id)->get();

        $data = [
            'subcategoria' => $subcategoria,
            'hijos' => $hijos
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Mostrando las ramas de la subcategoria solicitada',
            'data' => $data,
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
        $subcategoria->tag = Str::slug(Str::of($request->nombre)->lower());
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
        $subcategoria->tag = Str::slug(Str::of($request->nombre)->lower());
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
    
    public function syncData()
    {
        set_time_limit(60);
        //dd(public_path('storage').'/taxonomy_google.xlsx');
        $file = File::first();
 
        Excel::import(new SubcategoriaImport, $file->nombre,'public');

        return response()->json([
            'status' => 'success',
            'message' => 'Se importaron las categorias del Excel a la BD',
            'data' => NULL,
            'code' => 200
        ],200);
    }

    public function syncChild()
    {
        //dd(public_path('storage').'/stuff_google.xlsx');
        $file = File::first();
        Excel::import(new ChildImport, $file->nombre,'public');

        return response()->json([
            'status' => 'success',
            'message' => 'Se importaron las categorias del Excel a la BD',
            'data' => NULL,
            'code' => 200
        ],200);
    }
}
