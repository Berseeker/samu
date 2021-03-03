<?php

namespace App\Http\Controllers\API\Divisas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


use App\Models\Divisa;
use App\Models\Pais;

class DivisaController extends Controller
{
    public function index()
    {
        $divisas = Divisa::all();
        $data = null;
        $message = 'Se encontraron '.count($divisas).' divisas en la BD';
        if(!$divisas->isEmpty())
            $data = $divisas;
               
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => 200
        ],200);
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

        $prev = Divisa::where('moneda',$request->moneda)->first();
        if($prev != NULL){
            return response()->json([
                'status' => 'error',
                'message' => 'Esta divisa ya se encuentra registrada',
                'data' => NULL,
                'code' => 202
            ],202);
        }
            
        $divisa = new Divisa();
        $divisa->moneda = Str::upper($request->moneda);
        $divisa->valor = $request->valor;
        $divisa->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La divisa se creo exitosamente',
            'data' => $divisa,
            'code' => 201
        ],201);
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

    public function restore($id)
    {
        Divisa::withTrashed()
            ->where('id', $id)
            ->restore();

            return response()->json([
                'status' => 'success',
                'message' => 'La divisa se restauró correctamente',
                'data' => null,
                'code' => 200
            ],200);
    }

    public function import()
    {
        $paises = Pais::all();
        $pointer = 0;
        $count = 0;
        foreach($paises as $pais)
        {
            $currency = json_decode($pais->monedas);
            $prev = Divisa::where('alpha_code',$pais->alpha_code)->get();
            if($prev->isEmpty())
            {
                $divisa = new Divisa();
                $divisa->moneda = ($currency[0]->code == null) ? 'USD' : $currency[0]->code;
                $divisa->pais = $pais->nombre;
                $divisa->bandera = $pais->bandera;
                $divisa->alpha_code = $pais->alpha_code;
                $divisa->save();
                $count++;
            }
            else
            {
                $prev[0]->moneda = ($currency[0]->code == null) ? 'USD' : $currency[0]->code;
                $prev[0]->pais = $pais->nombre;
                $prev[0]->bandera = $pais->bandera;
                $prev[0]->alpha_code = $pais->alpha_code;
                $prev[0]->save();
                $pointer++;
            } 
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Se crearon '.$count.' divisas y se actualizaron '.$pointer.' divisas',
            'data' => NULL,
            'code' => 200
        ],200);
    }

}
