<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriberRequest extends FormRequest
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
            'first_name' => ['string', 'required', 'max:20'],
            'last_name' => ['string', 'required'],
            'birth' => ['date', 'date_format:Y-m-d'],
            'address' => ['required'],
            'phone' => ['required', 'digits:10','max:10','min:10'],
            'email' => ['email', 'required'],
        ];
    }
}
