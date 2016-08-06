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
    	//\JWTAuth::parseToken()->toUser();

         /*$results = DB::table('users')->leftJoin('user__skills','users.id','=','user__skills.user_id')->where('users.id', '=', $request->trainer_id)->where('user__skills.id', '=', $request->skill_id)->where('user__skills.experience_year', '=', $request->experience)->get();*/

         /*$users = User::whereId($request->trainer_id)->get();

         $users_with_skill = User_Skill::whereSkillsId($request->skill_id)->where('experience_year', '>=', $request->experience_year)->select('user_id');*/

         $searchString = '%' . $request->search . '%';

         $skills_ids = Skill::where('skill_name', 'like', $searchString)->select('id')->get();

         $trainer_ids = User::where('user_name', 'like', $searchString)->select('id')->get();

         $skill_id_array[] = '';
         $trainer_id_array[] = '1';

         foreach ($skills_ids as $skill_id) {
             $skill_id_array[] = $skill_id->id;
         }

         foreach ($trainer_ids as $trainer_id) {
             $trainer_id_array[] = $trainer_id->id;
         }

         $trainer_id_array[] = $request->trainer_id;

        /* $functionData = array('skill_id' => $request->skill_id, 'experience_year' => $request->experience_year, 'searchString' => $searchString, 'skill_id_array' => array($skill_id_array));*/

         $allUser = User::whereUserType('Trainer')->get();

         foreach ($allUser as $user) {
            $elegibleList = $user->user_skills()->where(function ($query) use ($request) {
                $query->where('skills_id', '=', $request->skill_id)
                      ->where('experience_year', '>=', $request->experience_year);
              })
             ->orWhereIn('skills_id', $skill_id_array)
             ->orWhere('experience_year', 'like', $searchString)
             ->get();

             if (in_array($user->id, $trainer_id_array) || !empty($elegibleList)) {
                $results[] = $user;

             }

         }
        

        //Log::info($request->skill_id);

         return response()->json(compact('searchString'));

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
}
