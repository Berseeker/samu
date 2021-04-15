<?php

namespace App\Http\Controllers\API\InputType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AtributosDinamicos;
use App\Models\InputType;

class InpuTypeController extends Controller
{
    public function index()
    {
        $inputs = InputType::all();
        $data = null;
        $message = 'Se encontraron '.count($inputs).' inputsTypes en la BD';
        if(!$inputs->isEmpty())
            $data = $inputs;
               
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => 200
        ],200);
    }

    public function show($id)
    {
        $input = InputType::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Se encontró el input solicitado',
            'data' => $input,
            'code' => 200
        ],200);
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

        return response()->json([
            'status' => 'success',
            'message' => 'El input se creo exitosamente',
            'data' => $input,
            'code' => 201
        ],201);
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

        return response()->json([
            'status' => 'success',
            'message' => 'El input se actualizó exitosamente',
            'data' => $input,
            'code' => 201
        ],201);
    }

    public function destroy($id)
    {
        $input = Input::findOrFail($id);
        $atributos = AtributosDinamicos::where('inputType_id',$input->id)->get();

        dd($atributos);
        $input->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'El input se eliminó exitosamente',
            'data' => NULL,
            'code' => 200
        ],200);
    }
}
