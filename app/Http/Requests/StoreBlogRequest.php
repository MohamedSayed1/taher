<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'slug_ar' => ['required', 'string', 'unique:blogs'],
            'blog_category_id' => 'required',
            'description_ar' => 'required',
            'body_ar' => 'required',
            'tags_ar' => 'required',
        ];
    }
}
