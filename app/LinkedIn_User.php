<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedIn_User extends Model
{
    //

    protected $fillable = [
        'linkedin_id'
    ];

    public function user_profile()
    {
        return $this->hasOne(User::class);
    }
}
