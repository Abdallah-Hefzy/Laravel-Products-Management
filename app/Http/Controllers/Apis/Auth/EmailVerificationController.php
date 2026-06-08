<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\User;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{

    use ApiTrait;

    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);
        $user = User::where('email' , $request->email)->first();
        $code = random_int(10000, 99999);
        $code_expired_at = now()->addMinutes(2);
        $user->code = $code;
        $user->code_expired_at = $code_expired_at;
        $user->save();
        Mail::to($user->email)->send(new EmailVerification($user));
        return $this->data(compact('user'), 'Verification code sent successfully');
    }

    public function checkCode(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'code' => ['required', 'digits:5']
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user->code != $request->code) {
            return $this->errorMessage([], 'Invalid code', 400);
        }

        if ($user->code_expired_at < now()) {
            return $this->errorMessage([], 'Code expired', 400);
        }
        $device_name = $request->device_name ?? $request->userAgent();
        $token = $user->createToken($device_name)->plainTextToken;
        $user->email_verified_at = now();
        $user->code = null;
        $user->code_expired_at = null;
        $user->save();
        return $this->data(compact('user', 'token'));
    }
}
