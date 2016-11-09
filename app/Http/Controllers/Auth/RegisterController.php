<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Storage;
use App\Http\Controllers\ImageThumbController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'contact_no' => 'required|digits:10',
            'gender' => 'required|in:male,female',
            'country' => 'required',
            'hobbies' => 'required',
            'about_me' => 'required|min:6',
            'date_of_birth' => 'date',
            'avatar' => 'required|image',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $avatars_org_dir = 'public/avatars/origional';
        Storage::makeDirectory($avatars_org_dir);

        if($avatar_file = $data['avatar']->store($avatars_org_dir)) // Upload avatar
        {
            $org_avatar_source = ltrim($avatar_file, 'public/');

            $thumbObj = new ImageThumbController();
            if($thumbpath = $thumbObj->getImageThumb($org_avatar_source, 500, 600)) // Create and upload avatar thumbnail
            {
                return User::create([
                    'name' => $data['name'],
                    'username' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'contact_no' => $data['contact_no'],
                    'gender' => $data['gender'],
                    'country' => $data['country'],
                    'hobbies' => $data['hobbies'],
                    'about_me' => $data['about_me'],
                    'date_of_birth' => $data['date_of_birth'],
                    'avatar' => $thumbpath,
                    'user_type' => 'blogger',
                    'social_id' => NULL,
                    'registration_type' => 'conventional',
                    'deleted_at' => NULL
                    ]);    
            } 
            else
            {
                return false;
            }
        }
    }
}
