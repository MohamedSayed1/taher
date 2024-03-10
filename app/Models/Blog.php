<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'slug_ar',
        'slug_en',
        'title_nl',
        'slug_nl',
        'blog_category_id',
        'description_ar',
        'description_en',
        'description_nl',
        'body_ar',
        'body_en',
        'body_nl',
        'tags_ar',
        'tags_en',
        'tags_nl',
        'image',
    ];

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id');
    }
}
