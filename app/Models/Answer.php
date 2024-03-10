<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_ar',
        'answer_en',
        'answer_nl',
        'main_answer',
        'question_id',
        'right_answer',
        'top_position',
        'left_position',
        'arrangment',
        'answer_image',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
