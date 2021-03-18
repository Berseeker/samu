<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Pais;

class Direccion extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $table = 'direcciones';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
        'tienda_id',
        'pais_id'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class,'pais_id');
    }
}
