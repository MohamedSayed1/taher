<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'title_nl',
        'slug_ar',
        'slug_en',
        'slug_nl',
        'body_ar',
        'body_en',
        'body_nl',
        'tags_ar',
        'tags_en',
        'tags_nl',
        'enabel'
    ];
}
