<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentReplyRequest extends FormRequest
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
            "replyPhoto" => "bail|image|max:10240|min:1",
            "content"   => "bail|max:65500"
        ];
    }

    public function messages(){
        return [
            "replyPhoto.image" => "Invalid file. Only photos are allowed...",
            "replyPhoto.max"   => "File too large. max 10MB...",
            "content.max"      => "The length of text entered is too large..."
        ];
    }
}
