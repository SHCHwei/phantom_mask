<?php

namespace App\Http\Requests;


class UserRequest extends BaseFormRequest
{
    public function messages(): array
    {
        return [
            'top.required' => 'top is required',
            'startDate.required' => 'Start date is required',
            'endDate.required' => 'End date is required',
            'startDate.date_format' => 'Start date format is not valid',
            'endDate.date_format' => 'End date format is not valid',
        ];
    }

    public function topBuyer(): array
    {
        return [
            'startDate' => 'required|date_format:Y-m-d H:i:s',
            'endDate' => 'required|date_format:Y-m-d H:i:s',
            'top' => 'required|numeric|min:1|max:10',
        ];
    }
}
