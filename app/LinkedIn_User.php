<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedIn_User extends Model
{
    //

    protected $fillable = [
        'linkedin_id'
    ];

    protected $hidden = [
      'created_at', 'updated_at', 'linkedin_id'
    ];

    public function user_profile()
    {
        return $this->hasOne(User::class, 'linkedin_id', 'linkedin_id');
    }
     
    public function contact_info()
    {
        return $this->hasOne(LinkedIn_Contact_Information::class, 'linkedin_id', 'linkedin_id');
    }

    public function publications()
    {
        return $this->hasMany(LinkedIn_Publication::class, 'linkedin_id', 'linkedin_id');
    }

    public function patents()
    {
        return $this->hasMany(LinkedIn_Patent::class, 'linkedin_id', 'linkedin_id');
    }

    public function languages()
    {
        return $this->hasMany(LinkedIn_Language::class,'linkedin_id', 'linkedin_id');
    }

    public function skills()
    {
        return $this->hasMany(LinkedIn_Skill::class, 'linkedin_id', 'linkedin_id');
    }

    public function certifications()
    {
        return $this->hasMany(LinkedIn_Certification::class, 'linkedin_id', 'linkedin_id');
    }

    public function educations()
    {
        return $this->hasMany(LinkedIn_Education::class, 'linkedin_id', 'linkedin_id');
    }

    public function courses()
    {
        return $this->hasMany(LinkedIn_Course::class, 'linkedin_id', 'linkedin_id');
    }

    public function volunteer()
    {
        return $this->hasMany(LinkedIn_Volunteer::class, 'linkedin_id', 'linkedin_id');
    }

    public function postions()
    {
        return $this->hasMany(LinkedIn_Position::class, 'linkedin_id', 'linkedin_id');
    }

    public function recommendations()
    {
        return $this->hasMany(LinkedIn_Recommendation::class, 'linkedin_id', 'linkedin_id');
    }
}
