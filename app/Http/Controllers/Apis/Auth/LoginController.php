<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\LoginRequest;
use App\Models\User;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    use ApiTrait;

    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return $this->errorMessage([], 'email or password is wrong', 422);
        }

        if (is_null($user->email_verified_at)) {
            return $this->data(compact('user'), 'User Not Verified', 403);
        }
        $device_name = $request->device_name ?? $request->userAgent();
        $token = $user->createToken($device_name)->plainTextToken;

        return $this->data(compact('user', 'token'));
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successMessage('You has been logged out successfully!', 200);
    }

    public function logoutAllDevice(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->successMessage('You has been logged out from all devices successfully!', 200);
    }
}
