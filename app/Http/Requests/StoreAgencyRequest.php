<?php

namespace App\Http\Requests;

use App\Models\Agency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAgencyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('agency_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'agency_code' => [
                'string',
                'min:3',
                'max:5',
                'nullable',
            ],
            'bank_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
