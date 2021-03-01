<?php

namespace App\Http\Controllers\API\Clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyEmail;
use App\Models\Cliente;
use Carbon\Carbon;
use Mail;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        if($clientes == null)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'No hay clientes registrados todavia',
                'data' => NULL,
                'code' => 200
            ],200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Se encontraron todos los clientes',
            'data' => $clientes,
            'code' => 200
        ],200);

    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Se encontro el cliente solicitado',
            'data' => $cliente,
            'code' => 200
        ],200);
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'nombre' => 'required',
            'email' => 'required|email',
        ];

        $messages = [
            'nombre.required' => 'Es necesario asignar un nombre al usuario',
            'email.required' => 'Por favor escribe un correo electronico',
            'email.email' => 'Formato invalido de correo electronico',
        ];

        $this->validate($request,$rules,$messages);

        $message = "";
        

        $user = Cliente::findOrFail($id);
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->foto_perfil = $request->foto_perfil;

        if($user->isDirty('email')){
            $user->email_verified_at = NULL;
            $message = 'Hemos mandado un correo de verificacion al nuevo correo que nos proporcionaste';
        }
        
        $user->save();

        verifyEmail($user->email_verified_at,$user->id,$user->email);

        return response()->json([
            'status' => 'success',
            'message' => 'El cliente se actualizo de manera correcta '.$message,
            'data' => $user,
            'code' => 200
        ],200);

    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->tokens()->delete();
        $cliente->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Se eliminó el cliente de manera correcta',
            'data' => NULL,
            'code' => 200
        ],200);
    }

    public function restore($id)
    {
        Cliente::withTrashed()
            ->where('id', $id)
            ->restore();

        return response()->json([
            'status' => 'success',
            'message' => 'Se restauró el cliente de manera correcta',
            'data' => NULL,
            'code' => 200
        ],200);
    }
}

function verifyEmail($email_verified_at,$id,$email){

    if($email_verified_at == NULL){
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