<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|max:1024|mimes:png,jpeg,jpg,gif',
            'name' => 'required|string|max:255'
        ];
    }
}