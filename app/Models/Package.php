<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'name_nl',
        'notes_ar',
        'notes_en',
        'notes_nl',
        'badge_ar',
        'badge_en',
        'badge_nl',
        'show_in_home',
        'arrangement',
        'exam_count',
        'price',
        'expiration_duration_in_dayes',
        'photo_phone',
        'photo_desktop',
        'color_background',
        'color_border'
    ];

    public function offer()
    {
        return $this->hasOne(Offer::class, 'package_id')->where('end_date','>',Carbon::now());
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'package_exams', 'package_id', 'exam_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'package_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'package_id');
    }
}
