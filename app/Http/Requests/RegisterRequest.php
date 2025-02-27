<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name'=> ['required','string','max:10'],
            'email'=> ['required','email','max:30','unique:users'],
            'password' =>['required','string','max:255','min:8','confirmed'],
        ];
    }
}
