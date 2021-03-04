<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subcategoria;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'icon', 'tag',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }
}
