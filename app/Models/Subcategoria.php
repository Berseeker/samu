<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Subcategoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'categoria_id', 'tag', 'child'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
