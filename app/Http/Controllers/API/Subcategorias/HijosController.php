<?php

namespace App\Http\Controllers\API\Subcategorias;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Subcate_hijos;
use App\Models\Subcategoria;

class HijosController extends ApiController
{
    public function index()
    {
        $subcategorias = Subcate_hijos::all();
        $message = 'Se encontraron '.count($subcategorias).' subcategorias (hijas) registradas';
        $data = null;
        if(!$subcategorias->isEmpty())
            $data = $subcategorias;

        return $this->successResponse($message,$data,200);
    }

    public function show($id)
    {
        $subcategoria = Subcate_hijos::with('subcategoria')->findOrFail($id);
        return $this->successResponse('Mostrando la subcategoria (hija) solicitada',$subcategoria,200);
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
        return $this->successResponse('La subcategoria (hijo) se creo exitosamente',$hijo,200);
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

        return $this->successResponse('La subcategoria se actualizó exitosamente',$hijo,200);
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
            return $this->successResponse('La subcategoria se elimino correctamente',null,200);

        return $this->errorResponse($message,$code);
    }
}
