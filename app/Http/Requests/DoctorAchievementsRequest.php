<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorAchievementsRequest extends FormRequest
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
            'ach_title' => "bail|required|max:100",
            'ach_content' => "bail|required|max:500",
            'ach_location' => "bail|required|max:100",
            'ach_photo' => "bail|required|image|max:10240",
            'ach_year' => "bail|required|regex:/^[0-9]+$/i",
            'ach_month' => "bail|required|regex:/^[0-9]+$/i",
            'ach_day' => "bail|required|regex:/^[0-9]+$/i",
        ];
    }

    public function messages(){
        return [
            'ach_title.required' => "The title can  not be empty...",
            'ach_title.max' => "Long title not allowed ...",
            'ach_title.required' => "The description can not be empty...",
            'ach_title.max' => "Long description  not  allowed ...",
            'ach_location.required' => "The location field can not be empty ...",
            'ach_location.max' => "Long location  not  allowed ...",
            'ach_photo.required' => "The photo is required",
            'ach_photo.image' => "Invalid file. Only photos are allowed...",
            'ach_photo.max' => "File too large. max 10MB...",
            'ach_year.required' => "The year can not be empty ...",
            'ach_year.regex' => "Invalid data for year...",
            'ach_month.required' => "The month can not be empty ...",
            'ach_month.regex' => "Invalid data from month ...",
            'ach_day.required' => "The day can not be empty ...",
            'ach_day.regex' => "Invalid data from day ...",
        ];
    }


}
