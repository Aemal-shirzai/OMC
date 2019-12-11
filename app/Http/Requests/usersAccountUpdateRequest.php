<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class usersAccountUpdateRequest extends FormRequest
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
            'username' => "required|min:3|max:20|regex:/^([a-zA-Z]+)([0-9]*)([-._]?)([a-zA-Z0-9]+)$/i|unique:accounts,username,".Auth::user()->id,
            'email' => 'required|string|email|max:100|unique:accounts,email,'.Auth::user()->id,
            "pPhone" => "bail|nullable|regex:/^([0-9+() ]+)-*([ 0-9-]+)$/i|max:25|min:3",
            "oPhone" => "bail|nullable|regex:/^([0-9+() ]+)-*([ 0-9-]+)$/i|max:25|min:3",
        ];
    }

    public function messages(){
        return [
            'username.required' => "The username can not be empty",
            'username.min'  => " Short username, add atleast 3 charachters",
            'username.max' => " Long usernames are not supported, max 20 charachters",
            'email.required' => "The email can not be empty",
            'email.max' => " Long emails are not supported",
            'pPhone.regext' => "invalid phone number",
            'pPhone.max' => " Long phone number",
            'oPhone.regext' => "invalid phone number",
            'oPhone.max' => " Long phone number",

        ];
    }

}
