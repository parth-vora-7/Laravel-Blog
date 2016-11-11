<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserProfileFieldsRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Storage;

class ProfileController extends Controller
{
    public function editProfile(User $user)
    {
        return view('profile.profile', compact('user'));
    }

    public function updateProfile(UserProfileFieldsRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->contact_no = $request->contact_no;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->hobbies = $request->hobbies;
        $user->about_me = $request->about_me;
        $user->date_of_birth = $request->date_of_birth;

        $avatars_org_dir = 'public/avatars/origional';
        Storage::makeDirectory($avatars_org_dir);

        if($request->avatar && $avatar_file = $request->avatar->store($avatars_org_dir)) // Upload avatar
        {
            $org_avatar_source = str_replace ('public', 'storage', $avatar_file);
            $user->avatar = $org_avatar_source;
        }

        $user->save();
        return redirect()->route('profile.edit', $user->id)->with(['message' => 'Your profile has been successfully updated.']);
    }

    public function changePassword(User $user)
    {
        return view('profile.changepassword', compact('user'));
    }

    public function udpatePassword(ChangePasswordRequest $request, User $user)
    {
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('password.change', $user)->with(['message' => 'Your password has been successfully updated.']);
        } else {
            return back()->withErrors('Current password doesn\'t macth');
        }
    }
}