<?php

namespace App\Http\Controllers\API\Tiendas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Tienda;
use App\Models\Categoria;
use App\Models\Direccion;

class TiendaController extends Controller
{
    public function index()
    {
        $tiendas = Tienda::with(['proveedor:id,name,email,telefono','direccion','categoria'])->get();

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
        $tienda = Tienda::with(['proveedor:id,name,email,telefono','direccion.pais','categoria'])->findOrFail($id);

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
            'categoria_id' => 'required',
            'celular' => 'required|numeric',
            'pais_id' => 'required|numeric',
            'ciudad' => 'required',
            'estado' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre a la tienda',
            'categoria_id.required' => 'Es necesario asignar una categoria a la que pertenece la tienda',
            'celular.required' => 'Favor de asignar un numero de celular',
            'celular.numeric' => 'Este campo solo acepta numeros',
            'pais_id.required' => 'Por favor selecciona un pais de procedencia',
            'pais_id.numeric' => 'Formato invalido para este campo',
            'ciudad.required' => 'Por favor escribe una ciudad',
            'estado.required' => 'Por favor escribe un estado '
        ];

        $this->validate($request,$rules,$messages);


        $tienda_prev = Tienda::where('user_id',Auth::user()->id)->get();
        $categoria = Categoria::findOrFail($request->categoria_id);

        $data = null;
        $message = 'El usuario ya cuenta con una tienda';
        $status = 'error';
        $code = 406;

        if($tienda_prev->isEmpty())
        {
            $tienda = new Tienda();
            $tienda->nombre = $request->nombre;
            $tienda->descripcion = $request->descripcion;
            $tienda->categoria_id = $categoria->id;
            $tienda->user_id = Auth::user()->id;
            $tienda->save();

            $direccion = new Direccion();
            $direccion->persona_x_recibe = $request->persona_x_recibe;
            $direccion->celular = $request->celular;
            $direccion->ciudad = $request->ciudad;
            $direccion->estado = $request->estado;
            $direccion->colonia_delegacion = $request->colonia_delegacion;
            $direccion->calle = $request->calle;
            $direccion->no_ext = $request->no_ext;
            $direccion->referencias = $request->referencias;
            $direccion->tienda_id = $tienda->id;
            $direccion->pais_id = $request->pais_id;
            $direccion->save();

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
            'categoria_id' => 'required',
            'celular' => 'required|numeric',
            'pais_id' => 'required|numeric',
            'ciudad' => 'required',
            'estado' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre a la tienda',
            'categoria_id.required' => 'Es necesario asignar una categoria a la que pertenece la tienda',
            'celular.required' => 'Favor de asignar un numero de celular',
            'celular.numeric' => 'Este campo solo acepta numeros',
            'pais_id.required' => 'Por favor selecciona un pais de procedencia',
            'pais_id.numeric' => 'Formato invalido para este campo',
            'ciudad.required' => 'Por favor escribe una ciudad',
            'estado.required' => 'Por favor escribe un estado '
        ];

        $this->validate($request,$rules,$messages);


        $tienda = Tienda::where('user_id',Auth::user()->id)->where('id',$id)->get();
        $categoria = Categoria::findOrFail($request->categoria_id);

        $direccion = Direccion::where('tienda_id',$tienda[0]->id)->get();

        $data = null;
        $message = 'La tienda solicitada no existe/El usuario no cuenta con permisos para acceder a esta tienda';
        $status = 'error';
        $code = 406;

        if(!$tienda->isEmpty() && !$direccion->isEmpty())
        {
            $tienda[0]->nombre = $request->nombre;
            $tienda[0]->descripcion = $request->descripcion;
            $tienda[0]->categoria_id = $categoria->id;
            $tienda[0]->save();

            $direccion[0]->celular = $request->celular;
            $direccion[0]->ciudad = $request->ciudad;
            $direccion[0]->estado = $request->estado;
            $direccion[0]->colonia_delegacion = $request->colonia_delegacion;
            $direccion[0]->calle = $request->calle;
            $direccion[0]->no_ext = $request->no_ext;
            $direccion[0]->referencias = $request->referencias;
            $direccion[0]->tienda_id = $tienda->id;
            $direccion[0]->pais_id = $request->pais_id;
            $direccion[0]->save();

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
