<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected static $logAttributes = ['*'];
    public function users()
    {
        $this->hasMany(User::class);
    }

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }

    static function validate($request)
    {
        $request->validate(
            [
                'name' => 'required',
                'permissions' => 'required|array|min:1'
            ]
        );
    }
}