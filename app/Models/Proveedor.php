<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes; 

    protected $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'deleted_at',
        'created_at',
        'rol_id',
        'email_verified_at',
        'current_team_id',
        'updated_at',
        'stripe_id',
        'profile_photo_path',
        'password',
        'verified_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('rol_id', 1);
        });
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class,'user_id');
    }

    public function store()
    {
        return $this->hasOne(Tienda::class,'user_id');
    }
}
