<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class MaskRequest extends BaseFormRequest
{
    public function messages(): array
    {
        return [
            'id.required' => 'id is required',
            'topLimit.required' => 'topLimit is required',
            'bottomLimit.required' => 'bottomLimit is required',
            'operators.required' => 'operators is required',
            'kinds.required' => 'kinds is required'
        ];
    }

    public function getMasks(): array
    {
        return [
            'id' => 'required|numeric',
        ];
    }

    public function priceAndKind(): array
    {
        return [
            'topLimit' => 'required|numeric',
            'bottomLimit' => 'required|numeric|min:0',
            'operators' => ['required', Rule::in(['>', '<', '>=', '<='])],
            'kinds' => 'required|numeric|min:1',
        ];
    }
}
