<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class UsersRequest extends ApiRequest
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
            'name' => 'required',
            'email' => 'bail|required|unique:users|email'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '氏名',
            'email' => 'Eメールアドレス'
        ];
    }
}
