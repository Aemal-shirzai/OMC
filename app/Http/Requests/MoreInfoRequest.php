<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoreInfoRequest extends FormRequest
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
            "country" => "bail|nullable|regex:/^[0-9]+$/i",
            "province" => "bail|nullable|regex:/^[0-9]+$/i",
            "district" => "bail|nullable|regex:/^[0-9]+$/i",
            "street" => "bail|nullable|regex:/^[^<>]*\s*$/i|max:200",
            "phone" => "bail|nullable|regex:/^([0-9+() ]+)-*([ 0-9-]+)$/i|max:25|min:3",
            "year" => "bail|regex:/^[0-9]+$/i",
            "month" => "bail|regex:/^[0-9]+$/i",
            "day" => "bail|regex:/^[0-9]+$/i",
            "photo" => "bail|image|max:10240|min:1",
            "Bio"   => "bail|max:200"
        ];
    }

    public function messages()
    {
        return [
            "country.regex" => "Invalied country name...",
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
            "Bio.max"   => "Too long maximum 200 charachters...",
        ];
    }
}
