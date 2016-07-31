<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User_Company extends Model
{
    //
    protected $fillable = ['company_name', 'company_type', 'designation'];

    protected $hidden = ['created_at', 'updated_at','user_id'];
}
