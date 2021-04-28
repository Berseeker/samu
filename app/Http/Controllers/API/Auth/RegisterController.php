<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Events\TiendaRegisterEvent;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Team;
use App\Models\Tienda;
use App\Models\Categoria;
use App\Models\Direccion;
use App\Models\Divisa;

use Mail;


class RegisterController extends ApiController
{
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
            'rol' => 'required'
        ];

        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre al usuario',
            'email.required' => 'Por favor escribe un correo electronico',
            'email.email' => 'Formato invalido de correo electronico',
            'password.required' => 'Por favor asigna una contraseña',
            'password.confirmed' => 'Es necesario que confirmes tu password',
            'password_confirmation.required' => 'Por favor confirma tu password',
            'password_confirmation.same' => 'Las contraseñas no concuerdan',
            'rol.required' => 'Por favor especifica si eres proveedor o cliente'
        ];

        $this->validate($request,$rules,$messages);

        if($request->rol == 'proveedor')
            $categoria = Categoria::findOrFail($request->categoria_id);

        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telefono = 00000000;
        $user->foto_perfil = null;
        $user->rol_id = ($request->rol == 'proveedor') ? 1 : 3;
        $user->save();


        $divisa = Divisa::findOrFail($request->divisa_id);

        if($request->rol == 'proveedor')
        {
            $tienda = new Tienda();
            $tienda->nombre = $request->tienda_nombre;
            $tienda->descripcion = $request->tienda_descripcion; // opcional
            $tienda->user_id = $user->id;
            $tienda->categoria_id = $categoria->id;
            $tienda->divisa_id = $divisa->id;
            $tienda->save();

        }
        if($request->rol == 'cliente')
        {
            $direccion = new Direccion();
            $direccion->persona_x_recibe = $request->persona_x_recibe;
            $direccion->celular = $request->celular;
            $direccion->ciudad = $request->ciudad;
            $direccion->estado = $request->estado;
            $direccion->colonia_delegacion = $request->colonia_delegacion;
            $direccion->calle = $request->calle;
            $direccion->no_ext = $request->no_ext;
            $direccion->referencias = $request->referencias;
            $direccion->user_id = $user->id;
            $direccion->pais_id = $request->pais_id;
            $direccion->save();
        }


        verifyEmail($user->email_verified_at,$user->id,$user->email);
        if($request->rol == 'proveedor')
            event(new TiendaRegisterEvent($tienda));

        return $this->successResponse('El usuario se registro exitosamente',$user,200);
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
