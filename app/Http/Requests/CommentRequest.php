<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
class CommentRequest extends FormRequest
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
            "content" => "bail|max:65500",
            "photo" => "bail|image|max:10240|min:1",
        ];
    }

    public function messages(){
        return [
            "content.max" => "To long comments are not allowed", 
            "photo.image" => "Invalid file. Only photos are allowed...",
            "photo.max"   => "File too large. max 10MB...",
        ];
    }
}
