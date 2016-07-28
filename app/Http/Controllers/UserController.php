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

    public function updateUserDetails(Request $request)
    {
        $user = \JWTAuth::parseToken()->toUser();

        $validation = \Validator::make($request->all(), [
              'user_name' => 'sometimes|required',
              'first_name' => 'sometimes|required',
              'last_name'=> 'sometimes|required',
              'email' => 'sometimes|required|email|unique:users,email,'.$user->id,
              'dob' => 'sometimes|required',
              'sex' => 'sometimes|required',
              'nationality'=> 'sometimes|required',
              'user_type'=> 'sometimes|required',
              'phone_number_mobile' => 'sometimes|required|digits_between:10,12',
              'phone_number_home' => 'sometimes|required|digits_between:10,12',
              'phone_number_work' => 'sometimes|required|digits_between:10,12',
              'twitter_account_name1'=> 'sometimes|required',
              'twitter_account_name2'=> 'sometimes|required',
              'password' => 'sometimes|required'
          ]);

        if($validation->fails())
         {
            return $validation->errors();
         }

         return $this->updateUser($user, $request);

    }

    public function updateSkill(Request $request)
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

    public function updateEducation(Request $request)
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

    public function updateCompany(Request $request)
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
        if(!empty($request->company_name))
        {
            $user_company->company_name = $request->company_name;
        }

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
        if(!empty($request->school_name))
        {
            $user_education->school_name = $request->school_name;
        }

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
        if(!empty($request->skill_name))
        {
            $user_skill->skill_name = $request->skill_name;
        }

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

        if(!empty($request->user_type))
        {
            $user->user_type = $request->user_type;
        }

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

    private function getUserDetails($user)
    {
        $user->load('educations', 'skills', 'companies');

        return response()->json(compact('user'));
    }
}
