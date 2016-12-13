<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class UserProfileFieldsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        $updating_user = $this->route('user');
        if (Auth::user()->can('update', $updating_user)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');
        
        return [
        'name' => 'required|max:255|regex:/^[a-zA-Z\s]*$/',
        'username' => ['required', 'min:3', 'max:255', 'regex:/^[a-zA-Z0-9\s]*$/', Rule::unique('users')->ignore($user->id, '_id')],
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id, '_id')],
        'contact_no' => 'digits:10',
        'gender' => 'in:male,female',
        'country' => '',
        'hobbies' => '',
        'about_me' => 'min:6',
        'date_of_birth' => 'date',
        'avatar' => 'image',
        ];
    }

    public function messages()
    {
        return [
        'name.regex' => 'Please enter a valid name',
        ];
    }
}