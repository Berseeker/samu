<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use App\Models\User;
use Mail;

class VerifyEmailController extends ApiController
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

            return $this->successResponse('El correo se envio de manera correcta, favor de verficar su email.',null,200);
        }
    }
}
