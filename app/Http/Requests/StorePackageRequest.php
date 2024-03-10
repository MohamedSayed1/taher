<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
            'expiration_duration_in_dayes' => 'required',
            "photo_phone"=> "required|image|mimes:jpeg,png,jpg,gif|max:2048",
            "photo_desktop"=> "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ];
    }
}
