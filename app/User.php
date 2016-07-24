<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password', 'first_name', 'last_name', 'dob', 'sex', 'nationality', 'phone', 'website', 'avatar_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function skills()
    {
        return $this->hasMany(User_Skill::class);
    }

    public function educations()
    {
        return $this->hasMany(User_Education::class);
    }

    public function companies()
    {
        return $this->hasMany(User_Company::class);
    }
}
