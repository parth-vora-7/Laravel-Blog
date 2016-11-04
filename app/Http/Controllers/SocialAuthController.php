<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirectToFacebook()
    {
    	 return Socialite::driver('facebook')->redirect();
    }

    public function returnFromFacebook()
    {
 		$fb_user = Socialite::driver('facebook')->user();
 		$user['id'] = $fb_user->user['id'];
 		$user['name'] = $fb_user->user['name'];
 		$user['email'] = $fb_user->user['email'];
 		$user['gender'] = $fb_user->user['gender'];
 		$user['avatar'] = $fb_user->avatar_original;

 		dd($user);
    }
}
