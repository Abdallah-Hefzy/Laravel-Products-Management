<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdatePersonalDetailsRequest;
use App\Models\User;
use App\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    use media;

    public function edit(User $user)
    {

        return view('backend.profile.edit', [
            'user' => $user
        ]);
    }

    public function updatePersonalDetails(UpdatePersonalDetailsRequest $request)
    {
        
        $user = Auth::user();

        $data = $request->except(['_token', 'profile_photo']);

        if ($request->hasFile('profile_photo')) {

            $this->deleteImage($user->profile_photo,'dist/img/users/');

            $data['profile_photo'] = $this->uploadImage($request->profile_photo,'dist/img/users/');
        }

        $user->update($data);
        return redirect()->route('my-profile.edit')->with('success', 'Your Personal Details Has Been Updated Successfully!');
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = Auth::user();
        $data = $request->only('password');
        $data['password'] = Hash::make($data['password']);
        
        $user->update($data);

        return redirect()->route('my-profile.edit')->with('success', 'Your Password Has Been Updated Successfully!');
    }

}
