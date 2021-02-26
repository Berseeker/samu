<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Divisa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'moneda', 'valor'
    ];

    protected $hidden =[
        'updated_at',
        'created_at',
        'deleted_at'
    ];
}
