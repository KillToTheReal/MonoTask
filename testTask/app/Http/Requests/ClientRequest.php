<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'plate_num' => ['unique:cars'],
            'full_name' => ["min:3",'max:100', 'regex:/$nr+\s+$nr+\s+$nr+\s*/'],
            'phone_num' => ["regex:/\+7([0-9]){10}/", "unique:clients"]
        ];
    }
}
