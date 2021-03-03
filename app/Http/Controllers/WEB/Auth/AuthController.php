<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Autenticacion/Login');
    }

    public function registro()
    {
        return Inertia::render('Autenticacion/Registro');
    }


}
