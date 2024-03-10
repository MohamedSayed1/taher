<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTheoryPackageRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required',
            'notes_ar' => 'required',
            'price' => 'required',
            'expiration_duration_in_dayes' => 'required'
        ];
    }
}
