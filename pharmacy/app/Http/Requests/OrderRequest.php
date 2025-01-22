<?php

namespace App\Http\Requests;


class OrderRequest extends BaseFormRequest
{

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'name can not be more than 100 characters',
            'startDate.required' => 'Start date is required',
            'endDate.required' => 'End date is required',
            'startDate.date_format' => 'Start date format is not valid',
            'endDate.date_format' => 'End date format is not valid',
        ];
    }

    public function buyMask()
    {
        return [
            'userID' => 'required',
            'userName' => 'required',
            'pharmacyName' => 'required',
            'maskName' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d H:i:s',
            'maskID' => 'required',
            'pharmacyID' => 'required',
        ];
    }

    public function statisticsByDate(): array
    {
        return [
            'startDate' => 'required|date_format:Y-m-d H:i:s',
            'endDate' => 'required|date_format:Y-m-d H:i:s',
        ];
    }

}
