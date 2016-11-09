<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserProfileFieldsRequest;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function editProfile(User $user)
    {
		return view('profile.profile', compact('user'));
    }

    public function updateProfile(UserProfileFieldsRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('profile.edit', $user->id)->with(['message' => 'Your profile has been successfully updated.']);
    }

    public function changePassword(User $user)
    {
		return view('profile.changepassword', compact('user'));
    }

    public function udpatePassword(ChangePasswordRequest $request, User $user)
    {

    }
}