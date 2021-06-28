<?php

namespace App\Http\Controllers\API\Tiendas;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Tienda;
use App\Models\Categoria;
use App\Models\Direccion;
use App\Models\Divisa;
use App\Models\Pais;

class TiendaController extends ApiController
{
    public function index()
    {
        $tiendas = Tienda::with(['proveedor:id,name,email,telefono','direccion','categoria'])->get();

        $data = null;
        $message = 'Se encontraron '.count($tiendas).' tiendas registradas';

        if(!$tiendas->isEmpty())
            $data = $tiendas;
        
        return $this->successResponse($message,$data,200);
    }

    public function show($id)
    {
        $tienda = Tienda::with(['proveedor:id,name,email,telefono','direccion.pais','categoria'])->findOrFail($id);
         
        $tienda->logo = Storage::disk('s3')->url($tienda->logo); 
        $tienda->caratula = Storage::disk('s3')->url($tienda->caratula); 

        return $this->successResponse('Mostrando la tienda solicitada',$tienda,200);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'categoria_id' => 'required',
            'celular' => 'required|numeric',
            'pais_id' => 'required|numeric',
            'ciudad' => 'required',
            'estado' => 'required',
            'divisa_id' => 'required'
        ];
        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre a la tienda',
            'categoria_id.required' => 'Es necesario asignar una categoria a la que pertenece la tienda',
            'celular.required' => 'Favor de asignar un numero de celular',
            'celular.numeric' => 'Este campo solo acepta numeros',
            'pais_id.required' => 'Por favor selecciona un pais de procedencia',
            'pais_id.numeric' => 'Formato invalido para este campo',
            'ciudad.required' => 'Por favor escribe una ciudad',
            'estado.required' => 'Por favor escribe un estado ',
            'divisa_id.required' => 'Por favor escoge una divisa base para tu tienda'
        ];

        $this->validate($request,$rules,$messages);


        $tienda_prev = Tienda::where('user_id',Auth::user()->id)->get();
        $categoria = Categoria::findOrFail($request->categoria_id);
        $divisa = Divisa::findOrFail($request->divisa_id);
        $pais = Pais::findOrFail($request->pais_id);

        if($tienda_prev->isEmpty())
        {
   
            $tienda = new Tienda();
            $tienda->nombre = $request->nombre;
            $tienda->descripcion = $request->descripcion;
            $tienda->categoria_id = $categoria->id;
            $tienda->divisa_id = $divisa->id;
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
            $direccion->cp = $request->cp;
            $direccion->pais_id = $pais->id;
            $direccion->save();

            return $this->successResponse("La tienda se creó correctamente",$tienda,201);
            
        }

        return $this->errorResponse('El usuario ya cuenta con una tienda',406);
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required',
            'categoria_id' => 'required',
            'celular' => 'required|numeric',
            'pais_id' => 'required|numeric',
            'ciudad' => 'required',
            'estado' => 'required',
            'divisa_id' => 'required'
        ];
        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre a la tienda',
            'categoria_id.required' => 'Es necesario asignar una categoria a la que pertenece la tienda',
            'celular.required' => 'Favor de asignar un numero de celular',
            'celular.numeric' => 'Este campo solo acepta numeros',
            'pais_id.required' => 'Por favor selecciona un pais de procedencia',
            'pais_id.numeric' => 'Formato invalido para este campo',
            'ciudad.required' => 'Por favor escribe una ciudad',
            'estado.required' => 'Por favor escribe un estado ',
            'divisa_id.required' => 'Por favor escoge una divisa base para la tienda'
        ];

        $this->validate($request,$rules,$messages);


        $tienda = Tienda::findOrFail($id);
        $categoria = Categoria::findOrFail($request->categoria_id);
        $divisa = Divisa::findOrFail($request->divisa_id);

        $direccion = Direccion::where('tienda_id',$tienda->id)->get();

        if($tienda->user_id != Auth::user()->id)
            return $this->errorResponse('El usuario no cuenta con permisos para acceder a esta tienda',403);
        

        $name = Auth::user()->id.'_'.Auth::user()->name;
        $path = null;
        $path_caratula = null;

        if($tienda->logo != null)
        {
            if (Storage::disk('s3')->exists($tienda->logo))
            {
                Storage::disk('s3')->delete($tienda->logo);
                $path = Storage::disk('s3')->put("usuarios/".$name."/tienda/logo", $request->file('logo'));
            }
        }else{
            $path = Storage::disk('s3')->put("usuarios/".$name."/tienda/logo", $request->file('logo'));
        }

        if($tienda->caratula != null)
        {
            if (Storage::disk('s3')->exists($tienda->caratula)) 
            {
                Storage::disk('s3')->delete($tienda->caratula);
                $path_caratula = Storage::disk('s3')->put('usuarios/'.$name.'/tienda/caratula', $request->file('caratula'));
            }
        }else{
            $path_caratula = Storage::disk('s3')->put('usuarios/'.$name.'/tienda/caratula', $request->file('caratula'));
        }
            

        $tienda->nombre = $request->nombre;
        $tienda->descripcion = $request->descripcion;
        $tienda->categoria_id = $categoria->id;
        $tienda->divisa_id = $divisa->id;
        $tienda->logo = $path;
        $tienda->caratula = $path_caratula;
        $tienda->save();

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

        return $this->successResponse("La tienda se actualizó correctamente",$tienda,201);
        
    }

    public function showTienda()
    {
        $tienda = Tienda::where('user_id',Auth::user()->id)->first();
        if($tienda == NULL)
            return $this->errorResponse('No tienes una tienda registrada',404);
        
        return $this->successResponse('Ok',$tienda,200);
    }

}
