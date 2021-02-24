<?php

namespace App\Http\Controllers\API\Divisas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Divisa;

class DivisaController extends Controller
{
    public function index()
    {
        $divisas = Divisa::all();

        if($divisas == null)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'No hay divisas registradas',
                'data' => null,
                'code' => 200
            ],200);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'Busqueda completa',
                'data' => $divisas,
                'code' => 200
            ],200);
        }
    }

    public function show($id)
    {
        $divisa = Divisa::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Se encontró la divisa solicitada',
            'data' => $divisa,
            'code' => 200
        ],200);
    }

    public function store(Request $request)
    {
        $rules = [
            'moneda' => 'required|min:2',
            'valor' => 'required|numeric'
        ];

        $messages = [
            'moneda.required' => 'Ingresa el tipo de moneda a utilizar Eje: USD',
            'moneda.min' => 'El tipo de moneda debe tener al menos 2 caracteres',
            'valor.required' => 'Ingresa el tipo de cambio que tiene en tu pais',
            'valor.numeric' => 'Formato invalido, el campo valor solo acepta numeros'
        ];

        $this->validate($request,$rules,$messages);

        $divisa = new Divisa();
        $divisa->moneda = $request->moneda;
        $divisa->valor = $request->valor;
        $divisa->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La divisa se creo exitosamente',
            'data' => $divisa,
            'code' => 200
        ],200);
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'moneda' => 'required|min:2',
            'valor' => 'required|numeric'
        ];

        $messages = [
            'moneda.required' => 'Ingresa el tipo de moneda a utilizar Eje: USD',
            'moneda.min' => 'El tipo de moneda debe tener al menos 2 caracteres',
            'valor.required' => 'Ingresa el tipo de cambio que tiene en tu pais',
            'valor.numeric' => 'Formato invalido, el campo valor solo acepta numeros'
        ];

        $this->validate($request,$rules,$messages);

        $divisa = Divisa::findOrFail($id);
        $divisa->moneda = $request->moneda;
        $divisa->valor = $request->valor;
        $divisa->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La divisa se actualizó exitosamente',
            'data' => $divisa,
            'code' => 200
        ],200);
    }

    public function destroy($id)
    {
        $divisa = Divisa::findOrFail($id);
        $divisa->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'La divisa se eliminó exitosamente',
            'data' => NULL,
            'code' => 200
        ],200);
    }
}
