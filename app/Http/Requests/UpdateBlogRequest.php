<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'blog_category_id' => 'required',
            'description_ar' => 'required',
            'body_ar' => 'required',
            'tags_ar' => 'required',
        ];
    }
}
