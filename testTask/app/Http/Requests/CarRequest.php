<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            "brand" => "required",
            "model" => "required",
            "color" => "required",
            "on_parking" => "required",
            "client_id" => "required",
            'plate_num' => 'min:6 | max:6 | unique:cars',
        ];
    }
}
