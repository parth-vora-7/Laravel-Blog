<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
        $avtar_file = $data['avatar']->store('avatars');

        return User::create([
            'name' => $data['name'],
            'username' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'contact_no' => $data['contact_no'],
            'gender' => $data['gender'],
            'country' => $data['country'],
            'hobbies' => serialize($data['hobbies']),
            'about_me' => $data['about_me'],
            'date_of_birth' => $data['date_of_birth'],
            'avatar' => $avtar_file,
            'user_type' => 'blogger',
            'registration_type' => 'conventional'
        ]);
    }
}
