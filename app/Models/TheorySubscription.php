<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheorySubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'theory_package_id',
        'price',
        'user_id',
        'subscription_date',
        'expiration_date',
        'whatsapp',
        'pay_type',
        'renewed_times',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package()
    {
        return $this->belongsTo(TheoryPackage::class, 'theory_package_id');
    }
}
