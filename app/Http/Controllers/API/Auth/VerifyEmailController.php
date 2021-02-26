<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use App\Models\User;
use Mail;

class VerifyEmailController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->email_verified_at == NULL)
        {
            $url = URL::temporarySignedRoute(
                'verify.email.custom',
                Carbon::now()->addMinutes(60),
                [
                    'id' => Auth::user()->getKey(),
                    'hash' => Hash::make(Auth::user()->getEmailForVerification()),
                ]
            );
    
            Mail::to($user->email)
                ->queue(new VerifyEmail($url));

            return response()->json([
                'status' => 'success',
                'message' => 'El correo se envio de manera correcta, favor de verficar su email.',
                'data' => null,
                'code' => 200
            ],200);
        }
    }
}
