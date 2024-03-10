<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'ID',
        'post_author',
        'user_email',
        'display_name'
    ];
    protected $table = 'f2tltwlrk_posts';

    public $timestamps = false;
}
