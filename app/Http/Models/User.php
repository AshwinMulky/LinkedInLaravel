<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'linkedin_id', 'user_name', 'email', 'password', 'first_name', 'last_name', 'dob', 'sex', 'nationality', 'user_type', 'phone_number_mobile', 'phone_number_home', 'phone_number_work', 'twitter_account_name1', 'twitter_account_name1'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'linkedin_id', 'password', 'remember_token', 'created_at', 'updated_at'
    ];


    public function user_skills()
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

    public function linkedin_profile()
    {
        return $this->hasOne(LinkedIn_User::class, 'linkedin_id','linkedin_id');
    }
}
