<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcate_hijos extends Model
{
    use HasFactory;

    protected $table = 'subcategoria_hijos';

    protected $fillable = [
        'nombre', 'subcategoria_id', 'tag'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class,'subcategoria_id');
    }
    
}
