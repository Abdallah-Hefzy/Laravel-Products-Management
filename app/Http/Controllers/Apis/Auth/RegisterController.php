<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\RegisterRequest;
use App\Models\User;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    use ApiTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->except(['password', 'password_confirmation']);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        return $this->data(compact('user'), '', 201);
    }
}
