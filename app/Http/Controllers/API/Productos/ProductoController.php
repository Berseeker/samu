<?php

namespace App\Http\Controllers\API\Productos;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\AtributosDinamicos;
use App\Models\Subcate_hijos;
use App\Models\Proveedor;
use App\Models\InputType;
use App\Models\Producto;
use App\Models\Seccion;
use App\Models\Tienda;
use App\Models\Variables;

class ProductoController extends ApiController
{

    public function index()
    {
        $proveedor = Proveedor::findOrFail(Auth::user()->id);
        $productos = Producto::where('tienda_id',$proveedor->store->id)->paginate();
        if($productos->isEmpty())
            return $this->successResponse('No hay productos registrados en la tienda',NULL,200);

        return $this->successResponse('Mostrando '.count($productos).' productos',$productos,200);
    }

    public function store(Request $request)
    {
        $rules = [
            'SKU' => 'required|alpha_num',
            'nombre' => 'required',
            'stock' => 'required|numeric',
            'precio_unitario' => 'required|numeric',
            'seccion_id' => 'required|numeric',
            /*'nombres_atributos*' => 'required',
            'input_type[]' => 'required|numeric',
            'valor_atributo[]' => 'required',
            'extra_value[]' => 'required|numeric',
            'default_value[]' => 'required|boolean',
            'plus_minus[]' => 'required',
            'is_date[]' => 'boolean'*/
        ];

        $messages = [
            'SKU.required' => 'El campo SKU es requerido',
            'SKU.alpha_num' => 'El campo SKU solo acepta caracteres Alpha Numericos',
            'nombre.required' => 'El campo nombre es requerido',
            'stock.required' => 'El campo stock es requerido',
            'stock.numeric' => 'El campo stock solo acepta numeros',
            'precio_unitario.required' => 'El campo precio unitario es requerido',
            'precio_unitario.numeric' => 'El campo precio unitario solo acepta numeros',
            'seccion_id.required' => 'Es necesario elegir una subcategoria',
            'seccion_id.numeric' => 'Formato invalido para la subcategoria',
            /*'nombre_atributos[].required' => 'Es necesario al menos agregar un caracteristica para el producto',
            'input_type[].required' => 'Es necesario asignar como se mostrara este atributo',
            'input_type[].numeric' => 'Formato invalido para este input_type',
            'valor_atributo[].required' => 'Este valor es necesario',
            'extra_value[].required' => 'Es necesario agregar un valor extra para esta opcion',
            'extra.value[].numeric' => 'Este campo solo acepta numeros',
            'default_value[].required' => 'Es necesario indicar cual sera el precio por default',
            'default_value[].boolean' => 'Formato invalido para el valor de default',
            'plus_minus[].required' => 'Es necesario asignar un modificador de precio',
            'is_date[].boolean' => 'Es necesario saber si sera campo de fecha',*/
        ];

        $this->validate($request,$rules,$messages);

        $child = Subcate_hijos::findOrFail($request->seccion_id);
        $tienda = Tienda::where('user_id',Auth::user()->id)->first();
        $holder_seccion = NULL;
        $holder_producto = NULL;

        DB::transaction(function() use ($request,$tienda,$child,$holder_seccion)
        {
            /* ---  Se crea la subcategoria custom en caso de que el cliente escriba una   ---*/
            if($request->filled('seccion_name')) 
            {
                $seccion = Seccion::create(
                    [
                        'nombre' => Str::title($request->seccion_name),
                        'tag' => Str::title($request->seccion_name),
                        'subcategoria_hijo_id' => $child->id
                    ]
                );
                $holder_seccion = $seccion;
            }

            $producto = Producto::create([
                'SKU' => $request->SKU,
                'nombre' => $request->nombre,
                'descripcion' => ($request->filled('descripcion')) ? $request->descripcion : NULL,
                'stock' => $request->stock,
                'precio_unitario' => $request->precio_unitario,
                'material' => ($request->filled('material')) ? $request->material : NULL,
                'peso_producto' => ($request->filled('peso_producto')) ? $request->peso_producto : NULL,
                'tienda_id' => $tienda->id,
                'subcategoria_id' => $child->subcategoria->id,
                'seccion_id' => ($holder_seccion == NULL) ? NULL : $holder_seccion->id
            ]);
            $holder_producto = $producto;
            
            $array_atributos = array();
            for($i = 0;$i < count($request->nombres_atributos); $i++)
            {
                $atributo = AtributosDinamicos::create(
                    [
                        'nombre' => $request->nombres_atributos[$i],
                        'inputType_id' => $request->input_type[$i],
                        'producto_id' => $producto->id

                    ]
                );
                
                array_push($array_atributos,$atributo);
            }

            for($i = 0;$i < count($request->nombres_atributos); $i++)
            {
                for($j = 0; $j < count($request->valorAtributo); $j++)
                {
                    $valor_x_atributo = Variables::create(
                        [
                            'valor' => $request->valorAtributo[$i][$j],
                            'default_value' => $request->defaultValue[$i][$j],
                            'cargo_extra' => $request->cargoExtra[$i][$j],
                            'plus_minus' => $request->minusPlus[$i][$j],
                            'modificador_precio' => $request->modPrecio[$i][$j],
                            'atributo_id' => $array_atributos[$i]->id
                        ]
                    );
                }
            }

        }); 
        
        return $this->successResponse('El producto se guardo exitosamente',$holder_producto,200);
    }
}
