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
}
