<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'SKU', 'nombre', 'descripcion', 'stock', 'precio_unitario',
        'material', 'peso_producto', 'tienda_id', 'subcategoria_id', 'seccion_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class,'subcategoria_id','id');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class,'seccion_id','id');
    }

    public function tienda()
    {
        return $this->belongsTo(Tienda::class);
    }

    public function atributos()
    {
        return $this->hasMany(AtributosDinamicos::class,'producto_id','id');
    }
}
