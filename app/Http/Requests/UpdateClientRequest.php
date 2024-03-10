<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        return [
            'name' => 'required|string|max:255',
            'email' => Rule::unique('users', 'email')->ignore($request->id),
            'phone' => Rule::unique('users', 'phone')->ignore($request->id),
            'old_password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8',
        ];
    }
}
