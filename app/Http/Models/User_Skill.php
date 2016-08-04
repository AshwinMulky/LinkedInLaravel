<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User_Skill extends Model
{
    //
    protected $fillable = ['skills_id', 'experience_year', 'experience_months', 'experience_level'];

    protected $hidden = ['created_at', 'updated_at'];


}
