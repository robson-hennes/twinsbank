<?php

namespace App\Http\Requests;

use App\Models\Bank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'bank_code' => [
                'string',
                'min:3',
                'max:10',
                'nullable',
            ],
        ];
    }
}
