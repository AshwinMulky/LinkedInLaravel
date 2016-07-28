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
     
    public function contact_info()
    {
        return $this->hasOne(LinkedIn_Contact_Information::class);
    }

    public function publications()
    {
        return $this->hasMany(LinkedIn_Publication::class);
    }

    public function patents()
    {
        return $this->hasMany(LinkedIn_Patent::class);
    }

    public function languages()
    {
        return $this->hasMany(LinkedIn_Language::class);
    }

    public function skills()
    {
        return $this->hasMany(LinkedIn_Skill::class);
    }

    public function certifications()
    {
        return $this->hasMany(LinkedIn_Certification::class);
    }

    public function educations()
    {
        return $this->hasMany(LinkedIn_Education::class);
    }

    public function courses()
    {
        return $this->hasMany(LinkedIn_Course::class);
    }

    public function volunteer()
    {
        return $this->hasMany(LinkedIn_Volunteer::class);
    }

    public function postions()
    {
        return $this->hasMany(LinkedIn_Position::class);
    }

    public function recommendations()
    {
        return $this->hasMany(LinkedIn_Recommendation::class);
    }
}
