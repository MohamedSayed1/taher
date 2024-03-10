<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'title_nl',
        'package_id',
        'start_date',
        'end_date',
        'discount_amount'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id')->orderBy('arrangement','ASC');
    }
}
