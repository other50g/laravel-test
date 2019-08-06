<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        return response()->error(
            '登録に失敗しました。入力内容を確認してください。',
            $validator->errors()->toArray(),
            [],
            422
        );
    }
}
