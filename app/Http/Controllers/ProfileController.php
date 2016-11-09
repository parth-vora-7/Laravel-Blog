<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserProfileFieldsRequest;

class ProfileController extends Controller
{
    public function editProfile(User $user)
    {
		return view('profile.profile', compact('user'));
    }

    public function updateProfile(UserProfileFieldsRequest $request)
    {
        dd($request->all());
    }

    public function changePassword()
    {
		return view('profile.password');
    }

    public function udpatePassword()
    {

    }
}
