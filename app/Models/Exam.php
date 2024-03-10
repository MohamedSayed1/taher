<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'arrangment',
        'name_ar',
        'name_en',
        'name_nl',
        'description_ar',
        'description_en',
        'description_nl',
        'questions_num',
        'attempt_num',
        'duration_in_minutes',
        'exam_category_auto_move'
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_exams', 'exam_id', 'package_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'exam_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');
    }

    public function examCategory()
    {
        return $this->hasMany(ExamCategory::class, 'exam_id')->orderBy('arrangment','asc');
    }
}
