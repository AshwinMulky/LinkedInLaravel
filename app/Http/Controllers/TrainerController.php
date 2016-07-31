<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\User;
use App\Http\Models\User_Skill;

use DB;

class TrainerController extends Controller
{
    //
    function __construct()
    {
    	$this->middleware('jwt.auth');
    }

    public function filterTrainers(Request $request)
    {
    	\JWTAuth::parseToken()->toUser();

         $results = DB::table('users')->leftJoin('user__skills','users.id','=','user__skills.user_id')->where('users.id', '=', $request->trainer_id)->where('user__skills.id', '=', $request->skill_id)->where('user__skills.experience_year', '=', $request->experience)->get();

         return response()->json(compact('results'));

    }

    public function listAllTrainers()
    {
        return DB::table('users')->where('user_type', 'Trainer')->select('id as Trainer_id', 'user_name as Trainer_name')->get();
    }


    public function listAllSkills()
    {
        //return User_Skill::all();

        return DB::table('user__skills')->select('id', 'skill_name')->get();
    }
}
