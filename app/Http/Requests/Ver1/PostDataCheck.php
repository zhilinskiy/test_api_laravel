<?php

namespace App\Http\Requests\Ver1;

use Illuminate\Foundation\Http\FormRequest;

class PostDataCheck extends FormRequest
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
            'user_key' => 'required',
            'content' => 'required',
            'js_files' => 'sometimes',
            'url' => 'required'
        ];
    }
}
