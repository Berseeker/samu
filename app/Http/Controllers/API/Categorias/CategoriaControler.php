<?php

namespace App\Http\Controllers\API\Categorias;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\CategoriaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\File;
use App\Models\Categoria;
use App\Models\Subcategoria;

class CategoriaControler extends ApiController
{
    public function index()
    {
        $categorias = Categoria::all();
        $message = 'Se encontraron '.count($categorias).' categorias registradas';
        $data = null;
        if(!$categorias->isEmpty())    
            $data = $categorias;

        return $this->successResponse($message,$data,200);
    }

    public function show($id)
    {
        $categoria = Categoria::with('subcategorias')->findOrFail($id);
        return $this->successResponse('Mostrando la categoria solicitada',$categoria,200);
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
        return $this->successResponse('La categoria se creo exitosamente',$categoria,200);
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
        return $this->successResponse('La categoria se actualizó exitosamente',$categoria,200);
    }

    public function delete($id)
    {
        $categoria = Categoria::findOrFail($id);
        $subcategorias = Subcategoria::where('categoria_id',$categoria->id)->get();

        if($subcategorias->isEmpty())
        {
            $categoria->delete();
            return $this->successResponse('La categoria se elimino correctamente',null,200);
        }

        return $this->errorResponse('No se puede borrar la categoria porque todavia hay subcategoria que dependen de ella',406);
    }

    public function syncData()
    {
        Excel::import(new CategoriaImport, 'excel/taxonomi_samu.xls','s3');
        return $this->successResponse('Se importaron las categorias del Excel a la BD',null,200);
    }

    public function storeFile(Request $request)
    {
        $rules = [
            'excel' => 'required'
        ];
        $messages = [
            'excel.required' => 'Adjunta un archivo'
        ];

        $this->validate($request,$rules,$messages);

        $path = Storage::disk('s3')->put('excel', $request->file('excel'));
        DB::table('excel')->insert([
            'nombre' => $path
        ]);
        return $this->successResponse('el archivo se subio exitosamente',null,200);
    }
}
