<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_ar',
        'question_en',
        'question_nl',
        'exam_category_id',
        'exam_id',
        'question_type',
        'question_image',
        'question_uuid',
        'arrangment',
        'answer_explanation_ar',
        'answer_explanation_en',
        'answer_explanation_nl',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id')->orderBy('arrangment','asc');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function examCategory()
    {
        return $this->belongsTo(ExamCategory::class, 'exam_category_id');
    }
}
