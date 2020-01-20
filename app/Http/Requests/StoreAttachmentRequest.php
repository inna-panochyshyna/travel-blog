<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'attachment' => 'required|max:1500|mimes:png,jpeg,jpg,gif',
            'title' => 'required|string|max:255',
            'text' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
        ];
    }
}