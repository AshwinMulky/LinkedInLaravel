<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Skill extends Model
{
    //
    protected $fillable = ['skill_name', 'experience_year', 'experience_months', 'experience_level'];

    protected $hidden = ['created_at', 'updated_at'];
}
