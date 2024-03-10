<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_ar' => 'required',
            'package_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_amount' => 'required'
        ];
    }
}
