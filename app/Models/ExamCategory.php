<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'name_nl',
        'description_ar',
        'description_en',
        'description_nl',
        'questions_num',
        'exam_id',
        'arrangment',
        'duration_type',
        'duration',
        'explaination_while_exam',
        'wrong_question_to_fail',
        'question_auto_move',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'exam_category_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_category_id')->orderBy('arrangment', 'asc');
    }
}
