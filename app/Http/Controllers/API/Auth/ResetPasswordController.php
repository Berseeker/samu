<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public $status,$message,$code,$data;

    public function index(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];

        $messages = [
            'email.required' => 'Favor de ingresar un Correo Electrónico',
            'email.email' => 'Formato invalido de Correo Electrónico'
        ];

        $this->validate($request,$rules,$messages);
        

        $user = User::where('email',$request->email)->first();
        if($user == null)
        {
            $this->status = 'error';
            $this->message = 'El email no esta registrado en Samu';
            $this->code = 404;
            $this->data = null;
        }else
        {
            $token = Str::random(60);
            $url = url('/recover-password/'.$user->email.'/'.$token);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]);

            Mail::to($user->email)
                ->queue(new ResetPassword($url));

            $this->status = 'success';
            $this->message = 'Se envió un email a tu correo, favor de revisar tu bandeja de entrada';
            $this->code = 200;
            $this->data = null;
        }

        return response()->json([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'code' => $this->code
        ],$this->code);

    }

    public function restore(Request $request)
    {
        $rules = [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'same:password'
        ];
        
        $messages = [
            'token.required' => 'Error con el token de seguridad',
            'email.required' => 'Error al obtener el email de la URL',
            'email.email' => 'Formato invalido para el email',
            'password.required' => 'Favor de escribir tu nueva contraseña',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed' => 'Favor de confirmar tu contraseña',
            'password_confirmation.same' => 'Las contraseñas no coinciden'
        ];

        $this->validate($request,$rules,$messages);

        $user = User::where('email',$request->email)->first();
        if($user == null)
        {
            $this->status = 'error';
            $this->message = 'Usuario no registrado';
            $this->code = 404;
            $this->data = null;
        }else
        {
            $token = DB::table('password_resets')->where('token', $request->token)->where('email',$user->email)->first();
            if($token != null){
                //3600 equivale a 1 hora
                if(Carbon::parse($token->created_at)->addSeconds(3600)->isPast())
                {
                    $this->status = 'error';
                    $this->message = 'Este usuario no hizo la peticion para resetear la contraseña';
                    $this->code = 403;
                    $this->data = null;
                }else
                {
                    DB::update('update users set password = ?, remember_token = ? where email = ?', [Hash::make($request->password),Str::random(60),$user->email]);
                    $this->status = 'success';
                    $this->message = 'La contraseña se reseteó de manera exitosa!';
                    $this->code = 202;
                    $this->data = null;
                }     
            }else{
                $this->status = 'error';
                $this->message = 'El token ya expiró';
                $this->code = 405;
                $this->data = null;
            }
        }
        return response()->json([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'code' => $this->code
        ],$this->code);
    }
}
