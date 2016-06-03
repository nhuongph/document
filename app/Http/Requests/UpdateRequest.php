<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'username' => 'required|max:255|min:4',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'email' => 'required|email',
            'avatar' => 'required|mimes:jpeg,jpg,png',
        ];
    }
    
    public function messages()
    {
        return [
            'id.required' => 'Not find account!',
            'id.unique' => 'Not find account!',
            'username.required' => 'Username not empty!',
            'username.max' => 'Username <255 character!',
            'username.min' => 'Username >4 character!',
            'username.unique' => 'Username has been use by other user!',
            'password.required'  => 'Password not empty!',
            'password.confirmed'  => 'Password not equal Re-password!',
            'password_confirmation.required'  => 'Re-Password not empty!',
            'email.required'  => 'Email not empty!',
            'email.email'  => 'Please input email!',
            'email.unique'  => 'Email has been use by other user!',
            'avatar.required'  => 'Select avartar! ',
            'avatar.mimes'  => 'Select image(jpeg,jpg,png)! ',
        ];
    }
}