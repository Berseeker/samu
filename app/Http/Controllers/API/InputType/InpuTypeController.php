<?php

namespace App\Http\Controllers\API\InputType;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AtributosDinamicos;
use App\Models\InputType;

class InpuTypeController extends ApiController
{
    public function index()
    {
        $inputs = InputType::all();
        $data = null;
        $message = 'Se encontraron '.count($inputs).' inputsTypes en la BD';
        if(!$inputs->isEmpty())
            $data = $inputs;
        
        return $this->successResponse($message,$data,200);
    }

    public function show($id)
    {
        $input = InputType::findOrFail($id);
        return $this->successResponse('Se encontró el input solicitado',$input,200);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required'
        ];
        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre al tipo de input'
        ];

        $this->validate($request,$rules,$messages);

        $input = new InputType();
        $input->nombre = Str::ucfirst(Str::of($request->nombre)->lower());
        $input->tag = Str::of($request->nombre)->lower();
        $input->save();
        return $this->successResponse('El input se creo exitosamente',$input,201);
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre al tipo de input'
        ];

        $this->validate($request,$rules,$messages);

        $input = InputType::findOrFail($id);
        $input->nombre = Str::ucfirst(Str::of($request->nombre)->lower());
        $input->tag = Str::of($request->nombre)->lower();
        $input->save();

        return $this->successResponse('El input se actualizó exitosamente',$input,201);
    }

    public function destroy($id)
    {
        $input = Input::findOrFail($id);
        $atributos = AtributosDinamicos::where('inputType_id',$input->id)->get();

        dd($atributos);
        $input->delete();

        return $this->successResponse('El input se eliminó exitosamente',null,200);
    }
}
