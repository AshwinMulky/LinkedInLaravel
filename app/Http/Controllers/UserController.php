<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User_Education;
use App\User_Skill;
use App\User_Company;

use DB;

class UserController extends Controller
{
    function __construct()
    {
    	$this->middleware('jwt.auth');
    }

    public function index()
    {

    	$user = \JWTAuth::parseToken()->toUser();

    	return $this->getUserDetails($user);
    }

    
    public function updateDetails(Request $request)
    {
        $user = \JWTAuth::parseToken()->toUser();

        $validation = \Validator::make($request->all(), [

              'user_type'=> 'required|in:Trainer,User,Company',

              'user_name' => 'sometimes|required_if:user_type,Trainer',
              'first_name' => 'sometimes|required_if:user_type,Trainer',
              'last_name'=> 'sometimes|required_if:user_type,Trainer',
              'email' => 'sometimes|required_if:user_type,Trainer|email|unique:users,email,'.$user->id,
              'dob' => 'sometimes|required_if:user_type,Trainer',
              'sex' => 'sometimes|required_if:user_type,Trainer',
              'nationality'=> 'sometimes|required_if:user_type,Trainer',
              
              'phone_number_mobile' => 'sometimes|required_if:user_type,Trainer|digits_between:10,12',
              'phone_number_home' => 'sometimes|required_if:user_type,Trainer|digits_between:10,12',
              'phone_number_work' => 'sometimes|required_if:user_type,Trainer|digits_between:10,12',
              'twitter_account_name1'=> 'sometimes|required',
              'twitter_account_name2'=> 'sometimes|required',
              'password' => 'sometimes|required',

              'company_name' => 'sometimes|required_if:user_type,Company',
              'company_type'=> 'sometimes|required_if:user_type,Company',
              'website_url' => 'sometimes|required_if:user_type,Company',
              'industries'=> 'sometimes|required_if:user_type,Company',
              'company_phone1' => 'sometimes|required_if:user_type,Company|digits_between:10,12',
              'company_phone2' => 'sometimes|required_if:user_type,Company|digits_between:10,12',
              'company_fax' => 'sometimes|required_if:user_type,Company',
              'employee_count_range'=> 'sometimes|required_if:user_type,Company',
              'specialties'=> 'sometimes|required_if:user_type,Company',
              'locations' => 'sometimes|required_if:user_type,Company',
              'description'=> 'sometimes|required_if:user_type,Company',
              'stock_exchange'=> 'sometimes|required_if:user_type,Company',
              'founded_year'=> 'sometimes|required_if:user_type,Company',
          ]);

        if($validation->fails())
         {
            return $validation->errors();
         }

         if($user->user_type == 'Trainer')
        {
            return $this->updateUser($user, $request);
        }
        else//company
        {
            return $this->updateCompany($user, $request);
        }

    }

    

    public function updateUserSkill(Request $request)
    {
        $user = \JWTAuth::parseToken()->toUser();

        $validation = \Validator::make($request->all(), [
              'skill_name' => 'required',
              'experience_year' => 'sometimes|required',
              'experience_months' => 'sometimes|required',
              'experience_level'=> 'sometimes|required'
          ]);

         if($validation->fails())
         {
            return $validation->errors();
         }

        $user_skill = $user->skills()->where('skill_name', $request->skill_name)->first();

        if(!empty($user_skill))
        {
            $this->updateSkillFromRequest($request, $user_skill);
        }
        else
        {
            $user_skill = User_Skill::create($request->all());

            $user->skills()->save($user_skill);
        }
        
        return $this->getUserDetails($user);
    }

    public function updateUserEducation(Request $request)
    {
        $user = \JWTAuth::parseToken()->toUser();

        $validation = \Validator::make($request->all(), [
              'school_name' => 'required',
              'field_of_study' => 'sometimes|required',
              'start_date' => 'sometimes|required',
              'end_date'=> 'sometimes|required',
              'degree' => 'sometimes|required',
              'activities' => 'sometimes|required',
              'notes'=> 'sometimes|required'
          ]);

         if($validation->fails())
         {
            return $validation->errors();
         }

         $user_education = $user->educations()->where('school_name', $request->school_name)->first();

        if(!empty($user_education))
        {
            $this->updateEducationFromRequest($request, $user_education);
        }
        else
        {
            $user_education = User_Education::create($request->all());

            $user->educations()->save($user_education);
        }
        
        return $this->getUserDetails($user);
    }

    public function updateUserCompany(Request $request)
    {
        $user = \JWTAuth::parseToken()->toUser();

        $validation = \Validator::make($request->all(), [
              'company_name' => 'required',
              'company_type' => 'sometimes|required',
              'designation' => 'sometimes|required'
          ]);

         if($validation->fails())
         {
            return $validation->errors();
         }

         $user_company = $user->companies()->where('company_name', $request->company_name)->first();

        if(!empty($user_company))
        {
            $this->updateCompanyFromRequest($request, $user_company);
        }
        else
        {
            $user_company = User_Company::create($request->all());

            $user->companies()->save($user_company);
        }
        
        return $this->getUserDetails($user);
    }

    private function updateCompanyFromRequest(Request $request, $user_company)
    {
        if(!empty($request->company_type))
        {
            $user_company->company_type = $request->company_type;
        }

        if(!empty($request->designation))
        {
            $user_company->designation = $request->designation;
        }

        $user_company->save();
    }


    private function updateEducationFromRequest(Request $request, $user_education)
    {
        if(!empty($request->field_of_study))
        {
            $user_education->field_of_study = $request->field_of_study;
        }

        if(!empty($request->start_date))
        {
            $user_education->start_date = $request->start_date;
        }

        if(!empty($request->end_date))
        {
            $user_education->end_date = $request->end_date;
        }

        if(!empty($request->degree))
        {
            $user_education->degree = $request->degree;
        }

        if(!empty($request->activities))
        {
            $user_education->activities = $request->activities;
        }

        if(!empty($request->notes))
        {
            $user_education->notes = $request->notes;
        }

        $user_education->save();
    }

    private function updateSkillFromRequest(Request $request, $user_skill)
    {
        if(!empty($request->experience_year))
        {
            $user_skill->experience_year = $request->experience_year;
        }

        if(!empty($request->experience_months))
        {
            $user_skill->experience_months = $request->experience_months;
        }

        if(!empty($request->experience_level))
        {
            $user_skill->experience_level = $request->experience_level;
        }

        $user_skill->save();
    }

    private function updateUser($user, Request $request)
    {
        if(!empty($request->user_name))
        {
            $user->user_name = $request->user_name;
        }

        if(!empty($request->first_name))
        {
            $user->first_name = $request->first_name;
        }

        if(!empty($request->last_name))
        {
            $user->last_name = $request->last_name;
        }

        if(!empty($request->email))
        {
            $user->email = $request->email;
        }

        if(!empty($request->dob))
        {
            $user->dob = $request->dob;
        }

        if(!empty($request->sex))
        {
            $user->sex = $request->sex;
        }

        if(!empty($request->nationality))
        {
            $user->nationality = $request->nationality;
        }

        /*if(!empty($request->user_type))
        {
            $user->user_type = $request->user_type;
        }*/

        if(!empty($request->phone_number_mobile))
        {
            $user->phone_number_mobile = $request->phone_number_mobile;
        }

        if(!empty($request->phone_number_home))
        {
            $user->phone_number_home = $request->phone_number_home;
        }

        if(!empty($request->phone_number_work))
        {
            $user->phone_number_work = $request->phone_number_work;
        }

        if(!empty($request->twitter_account_name1))
        {
            $user->twitter_account_name1 = $request->twitter_account_name1;
        }

        if(!empty($request->twitter_account_name2))
        {
            $user->twitter_account_name2 = $request->twitter_account_name2;
        }

        if(!empty($request->password))
        {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return $this->getUserDetails($user);
    }

    private function updateCompany($user, Request $request)
    {
        if(!empty($request->company_name))
        {
            $user->company_name = $request->company_name;
        }

        if(!empty($request->company_type))
        {
            $user->company_type = $request->company_type;
        }

        if(!empty($request->website_url))
        {
            $user->website_url = $request->website_url;
        }

        if(!empty($request->email))
        {
            $user->email = $request->email;
        }

        if(!empty($request->industries))
        {
            $user->industries = $request->industries;
        }

        if(!empty($request->company_phone1))
        {
            $user->company_phone1 = $request->company_phone1;
        }

        if(!empty($request->company_phone2))
        {
            $user->company_phone2 = $request->company_phone2;
        }

        if(!empty($request->company_fax))
        {
            $user->company_fax = $request->company_fax;
        }

        if(!empty($request->employee_count_range))
        {
            $user->employee_count_range = $request->employee_count_range;
        }

        if(!empty($request->specialties))
        {
            $user->specialties = $request->specialties;
        }

        if(!empty($request->locations))
        {
            $user->locations = $request->locations;
        }

        if(!empty($request->twitter_account_name1))
        {
            $user->twitter_account_name1 = $request->twitter_account_name1;
        }

        if(!empty($request->twitter_account_name2))
        {
            $user->twitter_account_name2 = $request->twitter_account_name2;
        }

        if(!empty($request->password))
        {
            $user->password = bcrypt($request->password);
        }

        if(!empty($request->description))
        {
            $user->description = bcrypt($request->description);
        }

        if(!empty($request->stock_exchange))
        {
            $user->stock_exchange = bcrypt($request->stock_exchange);
        }

        if(!empty($request->founded_year))
        {
            $user->founded_year = bcrypt($request->founded_year);
        }

        $user->save();

        return $this->getUserDetails($user);
    }

    private function getUserDetails($user)
    {
        $user->load('educations', 'skills', 'companies');

        $user = $this->hideUserFields($user);

        return response()->json(compact('user'));
    }

    public function hideUserFields($user)
    {
        if($user->user_type == 'Trainer')
        {
            $user->setHidden(['linkedin_id', 'password', 'remember_token', 'created_at', 'updated_at', 'company_name', 'company_type', 'website_url', 'industries', 'employee_count_range', 'specialties', 'locations', 'company_phone1', 'company_phone2', 'company_fax', 'description', 'stock_exchange', 'founded_year']);
        }

        if($user->user_type == 'Company')
        {
            $user->setHidden(['linkedin_id', 'password', 'remember_token', 'created_at', 'updated_at', 'user_name', 'first_name', 'last_name', 'dob', 'sex', 'nationality', 'phone_number_mobile', 'phone_number_home', 'phone_number_work','educations','skills','companies']);
        }
        
        return $user;
    }
}
