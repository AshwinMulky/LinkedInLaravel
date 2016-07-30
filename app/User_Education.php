<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Education extends Model
{
    //
    protected $fillable = ['school_name', 'field_of_study', 'start_date', 'end_date', 'degree', 'activities', 'notes'];

    protected $hidden = ['created_at', 'updated_at','user_id'];
}
