<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'name'  => 'required|max:50|min:2',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|min:5|max:40',
            'device_id' => 'required|min:10|max:50',
        ];
    }
}
