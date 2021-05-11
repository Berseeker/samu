<?php

namespace App\Http\Controllers\API\Productos;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\AtributosDinamicos;
use App\Models\InputType;
use App\Models\Seccion;

class ProductoController extends ApiController
{

    public function index()
    {
        $productos = Producto::factory()->has(Seccion::factory())->count(100)->create();
        dd($productos);

        $proveedor = Proveedor::findOrFail(Auth::user()->id);
        $productos = Producto::where('tienda_id',$proveedor->store->id)->paginate();
        if($productos->isEmpty())
            return $this->successResponse('No hay productos registrados en la tienda',NULL,200);

        return $this->successResponse('Mostrando '.count($prodcutos).' productos',$productos,200);
    }

    public function store()
    {
        
    }
}
