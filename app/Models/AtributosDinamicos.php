<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributosDinamicos extends Model
{
    use HasFactory;

    protected $table = "atributos_x_producto";

    protected $fillable = [
        'nombre', 'inputType_id', 'producto_id'
    ];
}
