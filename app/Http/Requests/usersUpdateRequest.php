<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class usersUpdateRequest extends FormRequest
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
            'fullName' => 'bail|required|string|max:60',
            'gender' => 'bail|required|regex:/^[0-1]?$/i',
            "country_id" => "bail|nullable|regex:/^[0-9]+$/i",
            "province" => "bail|nullable|regex:/^[0-9]+$/i",
            "district" => "bail|nullable|regex:/^[0-9]+$/i",
            "street" => "bail|nullable|regex:/^[^<>]*\s*$/i|max:200",
            "phone" => "bail|nullable|regex:/^([0-9+() ]+)-*([ 0-9-]+)$/i|max:25|min:3",
            "year" => "bail|regex:/^[0-9]+$/i",
            "month" => "bail|regex:/^[0-9]+$/i",
            "day" => "bail|regex:/^[0-9]+$/i",
            "Bio"   => "bail|max:200",
            "fields" => "bail|max:5"
        ];
    }

    public function messages(){
        return [
            "fullName.required" => "The fullName can not be empty",
            "fullName.string" => "Invalid fullName input",
            "fullName.max"  => "Long input for fullName field",
            "country_id.regex" => "Invalied country name...",
            "province.regex" => "Invalied country name...",
            "district.regex" => "Invalied country name...",
            "street.regex" => "Invalied address name...",
            "street.max" => "Too long address ... ",
            "phone.regex" => "Invalid phone Number...",
            "phone.max" => "Too long phone number ... ",
            "phone.min" => "Too short phone number ... ",
            "year.regex" => "Invalied year used...",
            "month.regex" => "Invalied month used...",
            "day.regex" => "Invalied day used...",
            "photo.max" => "file too large...",
            "photo.image" =>"The file must be a photo",
            "Bio.max"   => "Too long, maximum 200 charachters...",
            "fields.max" => "Only 5 fields are allowed",
        ];
    }
}
