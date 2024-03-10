<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeVideosController extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_nl',
        'title_en',
        'description_ar',
        'description_nl',
        'description_en',
        'video_link',
        'enabel',
        'video_link_id',
        'video_type',
        'image',
    ];
}
