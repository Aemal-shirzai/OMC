<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            "title" => "bail|required|max:190",
            "content" => "bail|required|max:65500",
            "tags"  =>  "bail|nullable|max:5",
            "photo" =>  "bail|image|max:10240",
        ];
    }


    public function messages(){
        return [
            "title.required" => "The title field can not be null",
            "title.max" => "Too long text for title, max 190 chars",
            "content.required" =>"The content field can not be null",
            "content.max" => "Too long text content",
            "tags.number" => "Invalid data inserted for tags",
            "tags.max"     => "Only 5 tags are allowed",
            "photo.image" => "Only photos are allowed",
            "photo.max" => "File too large. max 10MB...",

        ];
    }
}
