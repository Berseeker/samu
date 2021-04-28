<?php

namespace App\Http\Controllers\API\Direcciones;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Direccion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Pais;

class DireccionController extends ApiController
{
    public function index()
    {
        $direcciones = Direccion::where('user_id',Auth::user()->id)->get();
        $data = $direcciones;
        $message = 'Se encontró '.count($direcciones).' direccion(es)';
        if($direcciones->isEmpty())
            $data = null;

        return $this->successResponse($message,$data,200);
    }

    public function show($id)
    {
        $direccion = Direccion::where([
            ['id' , '=', $id],
            ['user_id', '=', Auth::user()->id]
        ])->get();

        if($direccion->isEmpty())
            return $this->errorResponse('No existe la direccion solicitada',404);

        return $this->successResponse('Mostrando la direccion solicitada',$direccion,200);
    }

    public function store(Request $request)
    {
        $rules = [
            'persona_x_recibe' => 'required|min:3',
            'celular' => 'required|numeric|min:8',
            'ciudad' => 'required|min:2',
            'estado' => 'required|min:2',
            'colonia_delegacion' => 'required|min:3',
            'calle' => 'required|min:4',
            'no_ext' => 'required',
            'pais_id' => 'required'
        ];
        $messages = [
            'persona_x_recibe.required' => 'Favor de asignar la persona que recibira el pedido',
            'persona_x_recibe.min' => 'El nombre de la persona debe tener al menos 3 caracteres',
            'celular.required' => 'Favor de ingresar el numero de contacto para avisar que el paquete va en camino',
            'celular.numeric' => 'Solo se aceptan números',
            'celular.min' => 'El numero de celular debe de tener al menos 8 digitos',
            'ciudad.required' => 'Favor de asignar una ciudad',
            'ciudad.min' => 'La ciudad asignada debe de tener al menos 2 caracteres',
            'estado.required' => 'Favor de asignar un valor al campo estado',
            'estado.min' => 'El estado asigando debe de tener al menos 2 caracteres',
            'colonia_delegacion.required' => 'Favor de asignar un valor al campo de Colonia/Municipio',
            'colonia_delegacion.min' => 'El campo debe de tener al menos 3 caracteres',
            'calle.required' => 'Favor de asignar un valor al campo calle',
            'calle.min' => 'El campo calle debe de tener al menos 4 caracteres',
            'no_ext.required' => 'Favor de asignar el numero exterior del inmueble',
            'pais_id.required' => 'Favor de asignar el pais donde se enviara el paquete'
        ];

        $this->validate($request,$rules,$messages);


        $pais = Pais::findOrFail($request->pais_id);

        $direccion = new Direccion();
        $direccion->persona_x_recibe = Str::title(Str::lower($request->persona_x_recibe));
        $direccion->celular = $request->celular;
        $direccion->ciudad = $request->ciudad;
        $direccion->estado = $request->estado;
        $direccion->colonia_delegacion = $request->colonia_delegacion;
        $direccion->calle = $request->calle;
        $direccion->no_ext = $request->no_ext;
        $direccion->referencias = ($request->has('referencias')) ? $request->referencias : NULL;
        $direccion->user_id = Auth::user()->id;
        $direccion->tienda_id = NULL;
        $direccion->pais_id = $pais->id;
        $direccion->save();

        return $this->successResponse('La dirección se creo exitosamente',$direccion,200);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'persona_x_recibe' => 'required|min:3',
            'celular' => 'required|numeric|min:8',
            'ciudad' => 'required|min:2',
            'estado' => 'required|min:2',
            'colonia_delegacion' => 'required|min:3',
            'calle' => 'required|min:4',
            'no_ext' => 'required',
            'pais_id' => 'required'
        ];
        $messages = [
            'persona_x_recibe.required' => 'Favor de asignar la persona que recibira el pedido',
            'persona_x_recibe.min' => 'El nombre de la persona debe tener al menos 3 caracteres',
            'celular.required' => 'Favor de ingresar el numero de contacto para avisar que el paquete va en camino',
            'celular.numeric' => 'Solo se aceptan números',
            'celular.min' => 'El numero de celular debe de tener al menos 8 digitos',
            'ciudad.required' => 'Favor de asignar una ciudad',
            'ciudad.min' => 'La ciudad asignada debe de tener al menos 2 caracteres',
            'estado.required' => 'Favor de asignar un valor al campo estado',
            'estado.min' => 'El estado asigando debe de tener al menos 2 caracteres',
            'colonia_delegacion.required' => 'Favor de asignar un valor al campo de Colonia/Municipio',
            'colonia_delegacion.min' => 'El campo debe de tener al menos 3 caracteres',
            'calle.required' => 'Favor de asignar un valor al campo calle',
            'calle.min' => 'El campo calle debe de tener al menos 4 caracteres',
            'no_ext.required' => 'Favor de asignar el numero exterior del inmueble',
            'pais_id.required' => 'Favor de asignar el pais donde se enviara el paquete'
        ];

        $this->validate($request,$rules,$messages);


        $pais = Pais::findOrFail($request->pais_id);

        $direccion = Direccion::findOrFail($id);
        $direccion->persona_x_recibe = Str::title(Str::lower($request->persona_x_recibe));
        $direccion->celular = $request->celular;
        $direccion->ciudad = $request->ciudad;
        $direccion->estado = $request->estado;
        $direccion->colonia_delegacion = $request->colonia_delegacion;
        $direccion->calle = $request->calle;
        $direccion->no_ext = $request->no_ext;
        $direccion->referencias = ($request->has('referencias')) ? $request->referencias : NULL;
        $direccion->user_id = Auth::user()->id;
        $direccion->tienda_id = NULL;
        $direccion->cp = $request->cp;
        $direccion->pais_id = $pais->id;
        $direccion->save();

        return $this->successResponse('La dirección se actualizó exitosamente',$direccion,200);
    }

    public function delete($id)
    {
        $direccion = Direccion::where('user_id',Auth::user()->id)->where('id',$id)->get();
        if($direccion->isEmpty())
            return $this->errorResponse('La dirección no existe/ La direccion no pertenece al usuario que intenta eliminarla',500);


        $direccion[0]->delete();
        return $this->successResponse('La dirección se eliminó correctamente',null,200);
    }

}
