<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputType extends Model
{
    use HasFactory;

    protected $table = "input_types";

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
