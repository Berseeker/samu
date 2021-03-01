<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function index(Request $request,$id,$email)
    {
        
        $user = User::find($id);
        
        Auth::login($user);
        
        if(!Hash::check($user->email,$email)){
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('dashboard');
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('verification.notice');
        }
    }
}
