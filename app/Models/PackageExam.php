<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'package_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
