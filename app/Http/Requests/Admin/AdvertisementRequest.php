<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
            'ads_title' => "bail|required|max:100",
            'ads_content' => "bail|required|max:500",
            'ads_category' => "bail|required|integer",
            'ads_photo' => "bail|required|image|max:10240",
            'ads_year' => "bail|required|regex:/^[0-9]+$/i",
            'ads_month' => "bail|required|regex:/^[0-9]+$/i",
            'ads_day' => "bail|required|regex:/^[0-9]+$/i",
        ];
    }



    public function messages(){
        return [
            'ads_title.required' => "The title can  not be empty...",
            'ads_title.max' => "Long title not allowed ...",
            'ads_title.required' => "The description can not be empty...",
            'ads_title.max' => "Long description  not  allowed ...",
            'ads_category.required' => "category is required...",
            'ads_category.number' => "Invalid input for cateory ...",
            'ads_photo.required' => "Image is required...",
            'ads_photo.image' => "Invalid file. Only photos are allowed...",
            'ads_photo.max' => "File too large. max 10MB...",
            'ads_year.required' => "The year can not be empty ...",
            'ads_year.regex' => "Invalid data for year...",
            'ads_month.required' => "The month can not be empty ...",
            'ads_month.regex' => "Invalid data from month ...",
            'ads_day.required' => "The day can not be empty ...",
            'ads_day.regex' => "Invalid data from day ...",
        ];
    }

}
