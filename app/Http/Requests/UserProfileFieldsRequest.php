<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\User;

class UserProfileFieldsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Need to change
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = User::find($this->route('user'));
        $userid = ($user) ? $user['_id'] : null;

        return [
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:users', Rule::unique('users')->ignore($userid)],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'contact_no' => 'required|digits:10',
            'gender' => 'required|in:male,female',
            'country' => 'required',
            'hobbies' => 'required',
            'about_me' => 'required|min:6',
            'date_of_birth' => 'date',
            'avatar' => 'required|image',
        ];
    }
}
