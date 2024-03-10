<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'faq_type',
        'question_ar',
        'question_en',
        'question_nl',
        'answer_ar',
        'answer_en',
        'answer_nl',
        'enable',
        'arrangment'
    ];
}
