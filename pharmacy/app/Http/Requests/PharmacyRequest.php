<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PharmacyRequest extends BaseFormRequest
{
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'name can not be more than 100 characters',
        ];
    }

    public function searchByOpeningHours(): array
    {
        return [
            'day' => ['string', 'required_without:hour', Rule::in(['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'])],
            'hour' => 'array:start,end|required_without:day',
            'hour.start' => 'required_with:hour|date_format:H:i:s',
            'hour.end' => 'required_with:hour|date_format:H:i:s',
        ];
    }

    public function keywordSearch(): array
    {
        return [
            'name' => 'required|max:100',
        ];
    }
}
