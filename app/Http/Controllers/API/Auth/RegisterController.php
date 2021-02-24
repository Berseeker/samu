<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use Mail;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
            'rol_id' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre al usuario',
            'email.required' => 'Por favor escribe un correo electronico',
            'email.email' => 'Formato invalido de correo electronico',
            'password.required' => 'Por favor asigna una contraseña',
            'password.confirmed' => 'Es necesario que confirmes tu password',
            'password_confirmation.required' => 'Por favor confirma tu password',
            'password_confirmation.same' => 'Las contraseñas no concuerdan',
            'rol_id.required' => 'Por favor especifica si eres medico o paciente'
        ];

        $this->validate($request,$rules,$messages);

        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telefono = $request->telefono;
        $user->foto_perfil = $request->foto_perfil;
        $user->rol_id = 3;
        $user->save();

        $team = new Team();
        $team->user_id = $user->id;
        $team->name = explode(' ', $user->name, 2)[0]."'s Team";
        $team->personal_team = true;
        $team->save();

        $user->current_team_id = $team->id;
        $user->save();

        verifyEmail($user->email_verified_at,$user->id,$user->email);

        return response()->json([
            'status' => 'success',
            'message' => 'El usuario se registro exitosamente',
            'data' => $user,
            'code' => 200
        ],200);
    }
}

function verifyEmail($email_verified_at,$id,$email){

    if($email_verified_at == NULL){
        Auth::loginUsingId($id);
        $url = URL::temporarySignedRoute(
            'verify.email.custom',
            Carbon::now()->addMinutes(60),
            [
                'id' => Auth::user()->getKey(),
                'hash' => Hash::make(Auth::user()->getEmailForVerification()),
            ]
        );

        Mail::to($email)
            ->queue(new VerifyEmail($url));
    }
}
