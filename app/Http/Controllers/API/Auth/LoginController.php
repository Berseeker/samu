<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $messages = [
            'email.required' => 'Es necesario asignar un valor al email',
            'email.email' => 'Formato invalido para el email',
            'password' => 'Es necesario asignar un valor al password'
        ];

        $this->validate($request,$rules,$messages);

        $user = User::where('email',$request->email)->get();
        if(!$user->isEmpty())
        {
            if(Hash::check($request->password,$user[0]->password)){
                //crear TOKEN para autenticacion de la SPA
                $token = $user[0]->createToken('login');

                return response()->json([
                    'status' => 'success',
                    'message' => 'Inicio de sesion exitoso',
                    'token' => $token->plainTextToken,
                    'data' => $user,
                    'code' => 200
                ],200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password/Email incorrectos',
                    'data' => null,
                    'code' => 500
                ],500);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Password/Email incorrectos',
                'data' => null,
                'code' => 500
            ],500);
        }
    }

    public function logout()
    {
        // Revoke the token that was used to authenticate the current request...
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Cierre de sesion exitoso',
            'data' => null,
            'code' => 200
        ],200);
    }
}
