<?php

namespace App\Http\Controllers\API\Categorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\CategoriaImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Categoria;
use App\Models\Subcategoria;

class CategoriaControler extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $message = 'Se encontraron '.count($categorias).' categorias registradas';
        $data = null;
        if(!$categorias->isEmpty())    
            $data = $categorias;
        
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => 200
        ],200);
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Mostrando la categoria solicitada',
            'data' => $categoria,
            'code' => 200
        ],200);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Por favor asigna un nombre a la categoria que se creará'
        ];

        $this->validate($request,$rules,$messages);

        $categoria = new Categoria();
        $categoria->nombre = Str::of(Str::of($request->nombre)->lower())->title();
        $categoria->icon = ($request->icon == "") ? 'fas fa-box' : $request->icon;
        $categoria->tag = Str::slug(Str::of($request->nombre)->lower());
        $categoria->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La categoria se creo exitosamente',
            'data' => $categoria,
            'code' => 200
        ],200); 
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Por favor asigna un nombre a la categoria que se creará'
        ];

        $this->validate($request,$rules,$messages);

        $categoria =  Categoria::findOrFail($id);
        $categoria->nombre = Str::of(Str::of($request->nombre)->lower())->title();
        $categoria->icon = ($request->icon == "") ? 'fas fa-box' : $request->icon;
        $categoria->tag = Str::slug(Str::of($request->nombre)->lower());
        $categoria->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La categoria se actualizó exitosamente',
            'data' => $categoria,
            'code' => 200
        ],200); 
    }

    public function delete($id)
    {
        $categoria = Categoria::findOrFail($id);
        $subcategorias = Subcategoria::where('categoria_id',$categoria->id)->get();

        $data = null;
        $message = 'No se puede borrar la categoria porque todavia hay subcategoria que dependen de ella';
        $status = 'error';
        $code = 406;
        if($subcategorias->isEmpty())
        {
            $categoria->delete();
            $message = 'La categoria se elimino correctamente';
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
        //dd(public_path('storage').'/taxonomy_google.xlsx');
        Excel::import(new CategoriaImport, 'taxonomy_google.xls');

        return response()->json([
            'status' => 'success',
            'message' => 'Se importaron las categorias del Excel a la BD',
            'data' => NULL,
            'code' => 200
        ],200);
    }
}
