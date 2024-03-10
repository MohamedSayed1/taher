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
            'expiration_duration_in_dayes' => 'required',
            "photo_phone"=> "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "photo_desktop"=> "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "cove_desktop_nl"=> "required_if:type_view,photo|nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "cove_desktop_en"=> "required_if:type_view,photo|nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "cove_desktop_ar"=> "required_if:type_view,photo|nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "cove_phone_ar"=> "required_if:type_view,photo|nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "cove_phone_nl"=> "required_if:type_view,photo|nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "cove_phone_en"=> "required_if:type_view,photo|nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ];
    }
}
