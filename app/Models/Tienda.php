<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Direccion;
use App\Models\Categoria;
use App\Models\User;

class Tienda extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
        'categoria_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function direccion()
    {
        return $this->hasOne(Direccion::class,'tienda_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoria_id');
    }
}
