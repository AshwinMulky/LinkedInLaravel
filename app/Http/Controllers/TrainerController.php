<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use DB;

class TrainerController extends Controller
{
    //
    function __construct()
    {
    	$this->middleware('jwt.auth');
    }

    public function listAll()
    {
    	return User::all()->where('user_type', 'Trainer');
    }

    public function filterTrainer(Request $request)
    {
    	\JWTAuth::parseToken()->toUser();

        $validation = \Validator::make($request->all(), [
              'skill_name' => 'sometimes|required',
              'experience_year' => 'sometimes|required',
             /* 'experience_months' => 'sometimes|required',*/
              'experience_level'=> 'sometimes|required'
          ]);

         if($validation->fails())
         {
            return $validation->errors();
         }

         $allUsers = User::all();

         foreach ($allUsers as $user) {
         	$hasSkills = $user->skills()->where('skill_name', $request->skill_name)/*->where('experience_year', $request->experience_year)->where('experience_level', $request->experience_level)*/->first();

         	if(!empty($hasSkills))
         	{
         		//$users[] = $user->load('educations', 'skills', 'companies');
         		$hasSkills->notEmpty = "yes";
         		$users[] = $hasSkills;
         	}
         	else
         	{
         		$users[] = "No matching users";
         	}
         }

         /*$users = DB::table('users')->join('user__skills','users.id','=','user__skills.user_id')->select('users.*')->where('user__skills.skill_name', $request->skill_name)->where('user__skills.experience_year', $request->experience_year)->where('user__skills.experience_level', $request->experience_level)->get();*/

         return response()->json(compact('users'));

    }
}
