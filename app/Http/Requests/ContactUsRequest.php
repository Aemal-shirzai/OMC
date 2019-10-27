<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            "fullName" => "bail|Required|regex:/^[^<>]*$/i|max:40|min:3",
            "phoneNumber" => "bail|Required|regex:/^([0-9+() ]+)-*([ 0-9-]+)$/i|max:25|min:3",
            "emailAddress" => "bail|Required|email",
            "message" => "bail|Required"
        ];
    }

    public function messages(){
        return [
            "required" => "The field can not be empty...",
            "fullName.regex" =>  "Invalid Name...",
            "phoneNumber.regex" => "Invalid phone Number..."
        ];
    }
}
