<?php

namespace App\Http\Controllers\API\Productos;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AtributosDinamicos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subcate_hijos;
use App\Models\Proveedor;
use App\Models\InputType;
use App\Models\Producto;
use App\Models\Seccion;
use App\Models\Tienda;
use App\Models\Variables;
use Illuminate\Support\Collection;

class ProductoController extends ApiController
{

    public function index()
    {
        $proveedor = Proveedor::findOrFail(Auth::user()->id);
        $productos = Producto::where('tienda_id',$proveedor->store->id)->get();
        $lista_productos = productoDTO($productos);
        $collecion = collect($lista_productos);// convertimos el array a coleccion
        $pagger = $collecion->paginate(2);
        if($productos->isEmpty())
            return $this->successResponse('No hay productos registrados en la tienda',NULL,200);

        return $this->successResponse('Mostrando '.count($pagger).' productos',$pagger,200);
    }

    public function show($id)
    {
        $proveedor = Proveedor::findOrFail(Auth::user()->id);
        $producto = Producto::findOrFail($id);
        $productos = array();
        array_push($productos,$producto);
        $lista_productos = productoDTO($productos);
        return $this->successResponse('Mostrando el articulo solicitado',$lista_productos[0],200);
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
        //$holder_seccion = NULL;
        $holder_producto = NULL;

        /* Se mandan todos los atrobutos a la transaccion*/
        $tag = Str::slug($request->nombre,'-');
        $name = Auth::user()->id.'_'.Auth::user()->name;
        $galeria = array();
        foreach($request->galeria as $img){
            $path = $img->storePublicly('usuarios/'.$name.'/tienda/productos/'.$tag,'s3');
            array_push($galeria,$path);
        }

        $material = ($request->filled('material')) ? $request->material : NULL;
        $peso = ($request->filled('peso_producto')) ? $request->peso_producto : NULL;
        $desc = ($request->filled('descripcion')) ? $request->descripcion : NULL;
        $sec_name = Str::title($request->seccion_name);
        $sec_tag = Str::title($request->seccion_name);

        DB::transaction(function() use ($request,$tienda,$child,$galeria,$material,$tag,$peso,$desc,$sec_name,$sec_tag)
        {
            $holder_seccion = NULL;
            /* ---  Se crea la subcategoria custom en caso de que el cliente escriba una   ---*/
            if($request->filled('seccion_name')) 
            {
                $seccion = Seccion::create(
                    [
                        'nombre' => $sec_name,
                        'tag_seccion' =>$sec_tag,
                        'subcategoria_hijo_id' => $child->id
                    ]
                );
                $holder_seccion = $seccion->id;
            }
            

            $producto = Producto::create([
                'SKU' => $request->SKU,
                'nombre' => $request->nombre,
                'descripcion' => $desc,
                'stock' => $request->stock,
                'precio_unitario' => $request->precio_unitario,
                'material' => $material,
                'peso_producto' => $peso,
                'tienda_id' => $tienda->id,
                'tag' => $tag,
                'subcategoria_id' => $child->subcategoria->id,
                'seccion_id' => $holder_seccion,
                'galeria' => json_encode($galeria)
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

    public function update(Request $request,$id)
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

        /* Se mandan todos los atributos a la transaccion*/
        $tag = Str::slug($request->nombre,'-');
        $name = Auth::user()->id.'_'.Auth::user()->name;
        $galeria = array();
        foreach($request->galeria as $img){
            $path = $img->storePublicly('usuarios/'.$name.'/tienda/productos/'.$tag,'s3');
            array_push($galeria,$path);
        }

        $material = ($request->filled('material')) ? $request->material : NULL;
        $peso = ($request->filled('peso_producto')) ? $request->peso_producto : NULL;
        $desc = ($request->filled('descripcion')) ? $request->descripcion : NULL;
        $sec_name = Str::title($request->seccion_name);
        $sec_tag = Str::title($request->seccion_name);


        /* ---  Se crea la subcategoria custom en caso de que el cliente escriba una   ---*/
        if($request->filled('seccion_name')) 
        {
            $seccion = Seccion::find($producto->seccion_id);
            if($seccion->isEmpty())
                $seccion = new Seccion();
                
            $seccion->nombre = $sec_name;
            $seccion->tag_seccion = $sec_tag;
            $seccion->subcategoria_hijo_id = $child->id ;
            $seccion->save();
        }
            

        $producto = Producto::findOrFail($id);
        $producto->SKU = $request->SKU;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $desc;
        $producto->stock = $request->stock;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->material = $material;
        $producto->peso_producto = $peso;
        $producto->tienda_id = $tienda->id;
        $producto->tag = $tag;
        $producto->subcategoria_id = $child->subcategoria->id;
        $producto->seccion_id = $holder_seccion;
        $prev_galeria = json_decode($producto->galeria);
        foreach($prev_galeria as $item)
        {
            if (Storage::disk('s3')->exists($item)) 
            {
                Storage::disk('s3')->delete($item);
            }
        }
        $producto->galeria = json_encode($galeria);
        $producto->save();
            

            
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


        
        return $this->successResponse('El producto se guardo exitosamente',$holder_producto,200);
    }
}

function productoDTO($productos)
{
    $array_atributos = array();
    $atributos = null;
    foreach ($productos as $producto)
    {
        $atributos = AtributosDinamicos::where('producto_id',$producto->id)->get();
        foreach($atributos as $atr){
            array_push($array_atributos,$atr);
        }
        
    }
    $array_variables = array();
    $variables = null;
    foreach($array_atributos as $item)
    {
        $variables = Variables::where('atributo_id',$item->id)->get();
        foreach($variables as $it){
            array_push($array_variables,$it);

        }    
    }

    $lista_productos = array();
    foreach ($productos as $item)
    {
        $child = Subcate_hijos::findOrFail($item->subcategoria_id);
        $local_atributos = array();
        foreach($array_atributos as $it)
        {
            if($it->producto_id == $item->id)
            {
                $local_variables = array();

                foreach($array_variables as $vari)
                {
                    if($vari->atributo_id == $it->id){
                        $y = [
                            'id' => $vari->id,
                            'nombre' => $vari->valor,
                            'default_value' => $vari->default_value,
                            'plus_minus' => $vari->plus_minus,
                            'cargo_extra' => $vari->cargo_extra,
                            'modificador_precio' => $vari->modificador_precio
                        ];
                        array_push($local_variables,$y);
                    }
                }

                $x = [
                    'id' => $it->id,
                    'nombre' => $it->nombre,
                    'inputType' => $it->inputType_id,
                    'valores' => $local_variables
                ];
                array_push($local_atributos,$x);
            }
            
        }
        $galeria = array();
        foreach(json_decode($item->galeria) as $img)
        {
            $aws_img = Storage::disk('s3')->url($img);
            array_push($galeria,$aws_img);
        }
        $producto = [
            'id' => $item->id,
            'SKU' => $item->SKU,
            'nombre' => $item->nombre,
            'descripcion' => $item->descripcion,
            'stock' => $item->stock,
            'precio_unitario' => $item->precio_unitario,
            'material' => $item->material,
            'peso_producto' => $item->peso_producto,
            'galeria' => $galeria,
            'tag' => $item->tag,
            'atributos' => $local_atributos,
            'subcategoria_id' => $child,
            'seccion_id' => $item->seccion_id
        ];

        array_push($lista_productos,$producto);
    }

    return $lista_productos;
}
