<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;
    protected $fillable = [
        'opinion',
        'enable',
        'user_id'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id')->orderBy('created_at', 'DESC');
    }
}
