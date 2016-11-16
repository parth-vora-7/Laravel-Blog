<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserProfileFieldsRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\SetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Storage;

class ProfileController extends Controller
{
    /**
     * Display a form to edit user profile.
     *
     * @param App\Uer $user
     */

    public function editProfile(User $user)
    {
        return view('profile.profile', compact('user'));
    }

    /**
     * Update and save user profile.
     *
     * @param App\Http\Requests\UserProfileFieldsRequest $request
     * @param App\Uer $user
     */

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
        $user->slack_webhook_url = $request->slack_webhook_url;

        $avatars_org_dir = 'public/avatars/origional';
        Storage::makeDirectory($avatars_org_dir);

        if($request->avatar && $avatar_file = $request->avatar->store($avatars_org_dir)) // Upload avatar
        {
            $org_avatar_source = str_replace ('public', 'storage', $avatar_file);
            $user->avatar = $org_avatar_source;
        }

        if($user->save()) {
            flash('Your profile has been successfully updated.', 'success')->important();
            return redirect()->route('profile.edit', $user->id);    
        } else {
            flash('Something went wrong. Please try again.', 'danger')->important();
            return back()->withInput();
        }
    }

    /**
     * Display a form to edit user password.
     *
     * @param App\Uer $user
     */

    public function changePassword(User $user)
    {
        return view('profile.changepassword', compact('user'));
    }

    /**
     * Update and save user password.
     *
     * @param App\Http\Requests\ChangePasswordRequest $request
     * @param App\Uer $user
     */

    public function udpatePassword(ChangePasswordRequest $request, User $user)
    {
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            flash('Your password has been successfully updated.', 'success')->important();
            return redirect()->route('password.change', $user);
        } else {
            flash('Current password doesn\'t macth', 'danger')->important();
            return back();
        }
    }

    /**
     * Display a form to set user password.
     *
     * @param App\Uer $user
     */

    public function setPassword(User $user)
    {
        return view('profile.setpassword', compact('user'));
    }

    /**
     * TO save password of a user.
     *
     * @param App\Http\Requests\SetPasswordRequest $request
     * @param App\Uer $user
     */

    public function savePassword(SetPasswordRequest $request, User $user)
    {
        $user->password = bcrypt($request->password);
        if($user->save()) {
            flash('Your password has been successfully set.', 'success')->important();
            return redirect()->route('profile.edit', $user);
        } else {
            flash('Something went wrong. Please try again.', 'danger');
            return back();
        }
    }
}