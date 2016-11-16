<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;
use App\User;
use Storage;
use Auth;
use App\Http\Controllers\ImageThumbController;
use Redirect;

class SocialAuthController extends Controller
{
	public function redirectToFacebook()
	{
		return Socialite::driver('facebook')->redirect();
	}

	public function returnFromFacebook()
	{
		$fb_user = Socialite::driver('facebook')->user();

		$user['social_id'] = $fb_user->id;
		$user['username'] = $fb_user->nickname;
		$user['name'] = $fb_user->name;
		$user['email'] = $fb_user->email;
		$user['gender'] = $fb_user->user['gender'];
		$user['avatar'] = $fb_user->avatar_original;
		$user['registration_type'] = 'facebook';
		$user['deleted_at'] = NULL;

		$this->authenticateSocialUser($user);
	}

	public function redirectToTwitter()
	{
		return Socialite::driver('twitter')->redirect();
	}

	public function returnFromTwitter()
	{
		$twitter_user = Socialite::driver('twitter')->user();
		$user['social_id'] = $twitter_user->id;
		$user['username'] = $twitter_user->nickname;
		$user['name'] = $twitter_user->name;
		$user['email'] = $twitter_user->email;
		$user['avatar'] = $twitter_user->avatar_original;
		$user['registration_type'] = 'twitter';
		$user['deleted_at'] = NULL;

		$this->authenticateSocialUser($user);
	}

	public function redirectToGoogle()
	{
		return Socialite::driver('google')->redirect();
	}

	public function returnFromGoogle()
	{
		$google_user = Socialite::driver('google')->user();
		$user['social_id'] = $google_user->id;
		$user['username'] = $google_user->nickname;
		$user['name'] = $google_user->name;
		$user['email'] = $google_user->email;
		$user['gender'] = $google_user->user['gender'];
		$user['avatar'] = $google_user->avatar_original;
		$user['registration_type'] = 'google';
		$user['deleted_at'] = NULL;

		$this->authenticateSocialUser($user);
	}

	public function redirectToLinkedin()
	{
		return Socialite::driver('linkedin')->redirect();
	}

	public function returnFromLinkedin()
	{
		$linkedin_user = Socialite::driver('linkedin')->user();
		$user['social_id'] = $linkedin_user->id;
		$user['username'] = $linkedin_user->nickname;
		$user['name'] = $linkedin_user->name;
		$user['email'] = $linkedin_user->email;
		$user['avatar'] = $linkedin_user->avatar_original;
		$user['registration_type'] = 'linkedin';
		$user['deleted_at'] = NULL;

		$this->authenticateSocialUser($user);
	}

	public function redirectToGithub()
	{
		return Socialite::driver('github')->redirect();
	}

	public function returnFromGithub()
	{
		$github_user = Socialite::driver('github')->user();
		$user['social_id'] = $github_user->user['id'];
		$user['name'] = $github_user->user['name'];
		$user['email'] = $github_user->user['email'];
		$user['avatar'] = $github_user->user['avatar_url'];
		$user['registration_type'] = 'github';
		$user['deleted_at'] = NULL;

		$this->authenticateSocialUser($user);
	}

	public function redirectToBitbucket()
	{
		return Socialite::driver('bitbucket')->redirect();
	}

	public function returnFromBitbucket()
	{
		$bitbucket_user = Socialite::driver('bitbucket')->user();
		$user['social_id'] = $bitbucket_user->id;
		$user['username'] = $bitbucket_user->nickname;
		$user['name'] = $bitbucket_user->name;
		$user['email'] = $bitbucket_user->email;
		$user['avatar'] = $bitbucket_user->avatar;
		$user['registration_type'] = 'bitbucket';
		$user['deleted_at'] = NULL;
		
		$this->authenticateSocialUser($user);
	}

	public function authenticateSocialUser($user)
	{
		$auth_user = User::select('_id')->where('social_id', '=', $user['social_id'])->get()->toArray();
		if(!empty($auth_user[0]))
		{
			$userid = $auth_user[0]['_id'];
		}
		else {
			$auth_user = $this->createUserFromSocialMdia($user);
			if(!$auth_user)
			{
				flash('This email has been already used.', 'danger')->important();
				return Redirect::back();
			}
			$userid = $auth_user->id;
			flash('Your account has been created. Please set your password.', 'success')->important();
            return redirect()->route('blog.index');
		}

		$login = Auth::loginUsingId($userid);
		if ( ! $login)
		{
			throw new \Exception('Error logging in');
		}

		return redirect('/'); 
	}

	public function createUserFromSocialMdia($user) 
	{
		if($user['avatar'] = $this->fetchSocialImage($user['avatar']))
		{
			$user['user_type'] = 'blogger';
			$user['deleted_at'] = NULL;
			if(isset($user['email']))
			{
				$user_email = User::select('email')->where('email', '=', $user['email'])->first();
				if(isset($user_email->email))
				{
					return false;
				}
			}
			
			return User::create($user);    
		}

	}

	public function fetchSocialImage($avatar_url)
	{
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
				),
			); 
		$avatars_org_dir = 'public/avatars/origional';
		Storage::makeDirectory($avatars_org_dir);

		$avatar_file_name = time() . '_' . rand() . '.jpg';
		$avatar_filepath = 'storage/avatars/origional/' . $avatar_file_name;

		if(file_put_contents($avatar_filepath, file_get_contents($avatar_url, false, stream_context_create($arrContextOptions)))) {
			return $avatar_filepath;
		}
		return false;
	}
}
