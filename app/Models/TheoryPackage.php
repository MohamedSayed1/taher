<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheoryPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name_ar',
        'name_en',
        'name_nl',
        'short_desc_ar',
        'short_desc_en',
        'short_desc_nl',
        'notes_ar',
        'notes_en',
        'notes_nl',
        'show_in_home',
        'arrangement',
        'price',
        'expiration_duration_in_dayes',
        'enable',
        ''
    ];

    public function subscriptions()
    {
        return $this->hasMany(TheorySubscription::class, 'theory_package_id');
    }
}
