<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variables extends Model
{
    use HasFactory;
    protected $table = "variables_x_atributos";

    protected $fillable = [
        'valor', 'default_value', 'cargo_extra', 'modificador_precio', 
        'atributo_id'
    ];
}
