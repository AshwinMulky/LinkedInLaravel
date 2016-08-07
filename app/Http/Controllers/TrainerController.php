<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\User;
use App\Http\Models\User_Skill;
use App\Http\Models\Skill;

use DB;
use Log;

class TrainerController extends Controller
{
    //
    function __construct()
    {
    	$this->middleware('jwt.auth');
    }

    public function filterTrainers(Request $request)
    {
    	$validation = \Validator::make($request->all(), [
              'search' => 'required',
              'trainer_id' => 'sometimes|required',
              'experience_year' => 'sometimes|required',
              'skill_id'=> 'sometimes|required'
          ]);

         if($validation->fails())
         {
            return $validation->errors();
         }


        $skill_id_array[] = '';
        $trainer_id_array[] = '';

        if(!empty($request->skill_id))
        {
            $skill_id = $request->skill_id;
        }
        else
        {
            $skill_id = '';
        }

        if(!empty($request->experience_year) )
        {
            $experience_year = $request->experience_year;
        }
        else
        {
            $experience_year = '';
        }
            

        $searchTerms = array('skill_id' => $skill_id, 'experience_year' => $experience_year);


        $searchString = '%' . $request->search . '%';

         $skills_ids = Skill::where('skill_name', 'like', $searchString)->select('id')->get();

         $trainer_ids = User::where('user_name', 'like', $searchString)->select('id')->get();

         

         foreach ($skills_ids as $skill_id) {
             $skill_id_array[] = $skill_id->id;
         }

         foreach ($trainer_ids as $trainer_id) {
             $trainer_id_array[] = $trainer_id->id;
         }

         $trainer_id_array[] = $request->trainer_id;

        /* $functionData = array('skill_id' => $request->skill_id, 'experience_year' => $request->experience_year, 'searchString' => $searchString, 'skill_id_array' => array($skill_id_array));*/

        Log::info('searchString ' . $searchString);
       /* print_r(array_values($skill_id_array));
        print_r(array_values($trainer_id_array));
        print_r(array_values($searchTerms));*/
        

         $allUser = User::whereUserType('Trainer')->get();

         foreach ($allUser as $user) {
            $elegibleList = $user->user_skills()->where(function ($query) use ($searchTerms) {
                $query->where('skills_id', '=', $searchTerms['skill_id'])
                      ->where('experience_year', '>=', $searchTerms['experience_year']);
              })
             ->orWhereIn('skills_id', $skill_id_array)
             ->orWhere('experience_year', '>=', $searchString)
             ->get();

             Log::info('elegibleList' . $elegibleList);
             Log::info(in_array($user->id, $trainer_id_array));
             //Log::info);
            // var_dump($elegibleList);

             if (in_array($user->id, $trainer_id_array) or !$elegibleList->isEmpty()) 
             {

                $results[] = $this->getUserDetails($user);

             }

         }
        

        //Log::info($request->skill_id);

         return response()->json(compact('results'));

    }

    public function listAllTrainers()
    {
        /*return DB::table('users')->where('user_type', 'Trainer')->select('id as Trainer_id', 'user_name as Trainer_name')->get();*/

        return User::whereUserType('Trainer')->select('id as Trainer_id', 'user_name as Trainer_name')->get();
    }


    public function listAllSkills()
    {
        /*return DB::table('user__skills')->select('skill_name')->groupBy('skill_name')->get();*/

        return Skill::select('id as skill_id', 'skill_name')->get();

    }

    private function getUserDetails($user)
    {
        $user->load('educations', 'user_skills', 'companies', 'linkedin_profile', 'linkedin_profile.contact_info', 'linkedin_profile.publications', 'linkedin_profile.patents', 'linkedin_profile.languages', 'linkedin_profile.skills', 'linkedin_profile.certifications', 'linkedin_profile.educations', 'linkedin_profile.courses', 'linkedin_profile.volunteer', 'linkedin_profile.postions', 'linkedin_profile.recommendations' );

        $user = $this->hideUserFields($user);

        return $user;
    }

    /*
     *  
     */
    public function hideUserFields($user)
    {

        if($user->user_type == 'Company')
        {
            $user->setHidden(['linkedin_id', 'password', 'remember_token', 'created_at', 'updated_at', 'user_name', 'first_name', 'last_name', 'dob', 'sex', 'nationality', 'phone_number_mobile', 'phone_number_home', 'phone_number_work','educations','user_skills','companies', 'self_rating', 'pricing']);
        }
        else
        {
            $user->setHidden(['linkedin_id', 'password', 'remember_token', 'created_at', 'updated_at', 'company_name', 'company_type', 'website_url', 'industries', 'employee_count_range', 'specialties', 'locations', 'company_phone1', 'company_phone2', 'company_fax', 'description', 'stock_exchange', 'founded_year']);
        }
        
        return $user;
    }
}
