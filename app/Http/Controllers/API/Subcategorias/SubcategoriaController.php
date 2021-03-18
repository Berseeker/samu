<?php

namespace App\Http\Controllers\API\Subcategorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ChildImport;
use App\Imports\SubcategoriaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use App\Models\File;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Subcate_hijos;
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
        $subcategoria = Subcategoria::with('hijos')->findOrFail($id);

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
        $hijos = Subcate_hijos::where('subcategoria_id',$subcategoria->id)->get();

        $data = null;
        $message = 'No se puede borrar la subcategoria porque todavia hay subcategorias (hijos) que dependen de ella';
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
        Excel::import(new SubcategoriaImport, 'excel/taxonomi_samu.xls','s3');
        Cache::flush();

        return response()->json([
            'status' => 'success',
            'message' => 'Se importaron las categorias del Excel a la BD',
            'data' => NULL,
            'code' => 200
        ],200);
    }

    public function syncChild()
    {
        Excel::import(new ChildImport, 'excel/taxonomi_samu.xls','s3');
        Cache::flush();

        return response()->json([
            'status' => 'success',
            'message' => 'Se importaron las categorias del Excel a la BD',
            'data' => NULL,
            'code' => 200
        ],200);
    }
}
