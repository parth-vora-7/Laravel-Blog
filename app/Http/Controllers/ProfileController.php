<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile()
    {
		return view('profile.profile', ['title' => 'Edit profile', 'button_text' => 'Update Profile']);
    }

    public function updateProfile()
    {

    }

    public function changePassword()
    {
		return view('profile.password');
    }

    public function udpatePassword()
    {

    }
}
