<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\ImageThumbController;
use App\Notifications\SignupComplete;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;

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
    use VerifiesUsers;

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
        $this->middleware('guest', ['getVerification', 'getVerificationError']);
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
            'username' => 'required|min:3|max:255|regex:/^[a-zA-Z0-9\s]*$/|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'contact_no' => 'digits:10',
            'gender' => 'in:male,female',
            'country' => '',
            'hobbies' => '',
            'about_me' => 'min:6',
            'date_of_birth' => 'date',
            'avatar' => 'image',
            ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $org_avatar_source = '';
        $avatars_org_dir = 'public/avatars/origional';
        Storage::makeDirectory($avatars_org_dir);

        if (isset($data['avatar'])) {
            if($avatar_file = $data['avatar']->store($avatars_org_dir)) // Upload avatar
            {
                $org_avatar_source = str_replace ('public', 'storage', $avatar_file);
            }
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'contact_no' => isset($data['contact_no']) ? $data['contact_no'] : '',
            'gender' => isset($data['gender']) ? $data['gender'] : '',
            'country' => isset($data['country']) ? $data['country'] : '',
            'hobbies' => isset($data['hobbies']) ? $data['hobbies'] : '',
            'about_me' => isset($data['about_me']) ? $data['about_me'] : '',
            'date_of_birth' => isset($data['date_of_birth']) ? $data['date_of_birth'] : '',
            'avatar' => $org_avatar_source,
            'user_type' => 'blogger',
            'social_id' => NULL,
            'registration_type' => 'conventional',
            'deleted_at' => NULL
        ]);  

        if($user) {
            UserVerification::generate($user);
            UserVerification::sendQueue($user, 'E-mail verification');

            flash('Please check your inbox and verify your email to login.', 'success')->important();
            $user->notify(new SignupComplete($user));
            return $user;
        }  else {
            return false;
        }
    }
}