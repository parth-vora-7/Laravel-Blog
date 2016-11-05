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

    public function redirectToTwitter()
    {
    	 return Socialite::driver('twitter')->redirect();
    }

    public function returnFromTwitter()
    {
		$twitter_user = Socialite::driver('twitter')->user();
		dd($twitter_user);
    }

    public function redirectToGoogle()
    {
    	 return Socialite::driver('google')->redirect();
    }

    public function returnFromGoogle()
    {
		$google_user = Socialite::driver('google')->user();
		dd($google_user);
    }

    public function redirectToLinkedin()
    {
    	 return Socialite::driver('linkedin')->redirect();
    }

    public function returnFromLinkedin()
    {
		$linkedin_user = Socialite::driver('linkedin')->user();
		dd($linkedin_user);
    }

    public function redirectToGithub()
    {
    	 return Socialite::driver('github')->redirect();
    }

    public function returnFromGithub()
    {
    	$github_user = Socialite::driver('github')->user();
    	$user['id'] = $github_user->user['id'];
 		$user['name'] = $github_user->user['name'];
 		$user['email'] = $github_user->user['email'];
 		$user['avatar'] = $github_user->user['avatar_url'];
 		dd($user);
    }

    public function redirectToBitbucket()
    {
    	 return Socialite::driver('bitbucket')->redirect();
    }

    public function returnFromBitbucket()
    {
    	$bitbucket_user = Socialite::driver('bitbucket')->user();
		dd($bitbucket_user);
    }
}
