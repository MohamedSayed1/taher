<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'attempt_num',
        'score',
        'json_score',
        'passed_exam',
        'total_current_questions',
        'total_right_questions',
        'total_wrong_questions',
        'total_skiped_questions',
        'total_not_answered_questions',
        'total_flaged_questions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
