<?php

namespace App\Http\Controllers\API\Tiendas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tienda;
use App\Models\Subcategoria;

class TiendaController extends Controller
{
    public function index()
    {
        $tiendas = Tienda::all();

        $data = null;
        $message = 'Se encontraron '.count($tiendas).' tiendas registradas';

        if(!$tiendas->isEmpty())
            $data = $tiendas;
        

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => 200
        ],200);
    }

    public function show($id)
    {
        $tienda = Tienda::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Mostrando la tienda solicitada',
            'data' => $tienda,
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
            'nombre.required' => 'Es necesario asignar un nombre a la tienda',
            'subcategoria_id.required' => 'Es necesario asignar una categoria a la que pertenece la tienda'
        ];

        $this->validate($request,$rules,$messages);


        $tienda_prev = Tienda::where('user_id',Auth::user()->id)->get();
        $subcategoria = Subcategoria::findOrFail($request->subcategoria_id);

        $data = null;
        $message = 'El usuario ya cuenta con una tienda';
        $status = 'error';
        $code = 406;

        if($tienda_prev->isEmpty())
        {
            $tienda = new Tienda();
            $tienda->nombre = $request->nombre;
            $tienda->descripcion = $request->descripcion;
            $tienda->subcategoria_id = $subcategoria->id;
            $tienda->user_id = Auth::user()->id;
            $tienda->save();

            $message =  "La tienda se creó correctamente";
            $data = $tienda;
            $status = 'success';
            $code = 201;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ],$code);
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required',
            'subcategoria_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre a la tienda',
            'subcategoria_id.required' => 'Es necesario asignar una categoria a la que pertenece la tienda'
        ];

        $this->validate($request,$rules,$messages);


        $tienda = Tienda::where('user_id',Auth::user()->id)->where('id',$id)->get();
        $subcategoria = Subcategoria::findOrFail($request->subcategoria_id);

        $data = null;
        $message = 'La tienda solicitada no existe/El usuario no cuenta con permisos para acceder a esta tienda';
        $status = 'error';
        $code = 406;

        if(!$tienda->isEmpty())
        {
            $tienda->nombre = $request->nombre;
            $tienda->descripcion = $request->descripcion;
            $tienda->subcategoria_id = $subcategoria->id;
            $tienda->save();

            $message =  "La tienda se actualizó correctamente";
            $data = $tienda;
            $status = 'success';
            $code = 200;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ],$code);
    }

}
