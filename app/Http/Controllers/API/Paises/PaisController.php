<?php

namespace App\Http\Controllers\API\Paises;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Events\ProductoPublicado;
use App\Models\Pais;

class PaisController extends ApiController
{
    public function index()
    {
        $data = NULL;
        $message = "No hay paises registrados en la BD";
        $paises = Pais::all();
        if(!$paises->isEmpty()){
            $data = $paises;
            $message = 'Se encontraron '.count($paises).' paises en la BD';
        }
        return $this->successResponse($message,$data,200);
    }

    public function show($id)
    {
        $pais = Pais::findOrFail($id);
        return $this->successResponse('Mostrando el pais solicitado',$pais,200);
    }

    public function delete($id)
    {
        $pais = Pais::findOrFail($id);
        $pais->delete();
        return $this->successResponse('El pais se eliminó correctamente',null,200);
    }

    public function restore($id)
    {
        Pais::withTrashed()
            ->where('id', $id)
            ->restore();
        return $this->successResponse('El pais se restauró correctamente',null,200);
    }

    public function syncData()
    {
        $data = Http::get('https://restcountries.eu/rest/v2/all');

        $response = $data->json();
        $count = 0;
        $pointer = 0;

        foreach($response as $row){

            $check = Pais::where('nombre',$row['name'])->get();

            if($check->isEmpty())
            {
                //dd(json_encode($row['latlng']));
                $pais = new Pais();
                $pais->nombre = $row['name'];
                $pais->alpha_code = $row['alpha2Code'];
                $pais->alpha_code_2 = $row['alpha3Code'];
                $pais->callingCodes = json_encode($row['callingCodes']);
                $pais->capital = $row['capital'];
                $pais->region = $row['region'];
                $pais->latlng = json_encode($row['latlng']);
                $pais->monedas = json_encode($row['currencies']);
                $pais->bandera = $row['flag'];
                $pais->save();
                $pointer++;
            }else{
                $pais = Pais::where('nombre',$row['name'])->first();
                $pais->nombre = $row['name'];
                $pais->alpha_code = $row['alpha2Code'];
                $pais->alpha_code_2 = $row['alpha3Code'];
                $pais->callingCodes = json_encode($row['callingCodes']);
                $pais->capital = $row['capital'];
                $pais->region = $row['region'];
                $pais->latlng = json_encode($row['latlng']);
                $pais->monedas = json_encode($row['currencies']);
                $pais->bandera = $row['flag'];
                $pais->save();
                if($pais->isDirty())
                    $count++;
            }
        }
        return $this->successResponse('Se agregaron '.$pointer.' y se actualizaron '.$count.' paises a la BD',null,200);
    }
}
