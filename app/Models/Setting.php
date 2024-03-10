<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'home_meta_tags_ar',
        'home_meta_tags_en',
        'home_meta_tags_nl',
        'home_meta_title_ar',
        'home_meta_title_en',
        'home_meta_title_nl',
        'sit_title_ar',
        'sit_title_en',
        'sit_title_nl',
        'home_meta_description_ar',
        'home_meta_description_en',
        'home_meta_description_nl',
        'home_meta_image',
        'facebook',
        'tweeter',
        'whatsapp',
        'youyube',
        'home_title_ar',
        'home_title_en',
        'home_title_nl',
        'home_description_ar',
        'home_description_en',
        'home_description_nl',
        'test_exam_id',
        'why_eltaher_desc_ar',
        'why_eltaher_desc_en',
        'why_eltaher_desc_nl',
        'why_eltaher_first_title_ar',
        'why_eltaher_first_title_en',
        'why_eltaher_first_title_nl',
        'why_eltaher_first_desc_ar',
        'why_eltaher_first_desc_en',
        'why_eltaher_first_desc_nl',
        'why_eltaher_secound_title_ar',
        'why_eltaher_secound_title_en',
        'why_eltaher_secound_title_nl',
        'why_eltaher_secound_desc_ar',
        'why_eltaher_secound_desc_en',
        'why_eltaher_secound_desc_nl',
        'lang',
        'default_lang',
        'lang_ar',
        'lang_en',
        'lang_nl',
        'reserve_exam_desc_ar',
        'reserve_exam_desc_en',
        'reserve_exam_desc_nl',
        'footer_desc_ar',
        'footer_desc_en',
        'footer_desc_nl',
        'main_phone',
        'secoundry_phone',
        'email',
        'address_ar',
        'address_en',
        'address_nl',
        'lat',
        'lon',
        'exam_header_description_ar',
        'exam_header_description_en',
        'exam_header_description_nl',
        'login_youtube'
    ];
}
