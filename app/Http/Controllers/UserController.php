<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User_Education;

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

    public function updateUser($user, Request $request)
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

    public function getUserDetails($user)
    {
        $user->load('educations', 'skills', 'companies');

        return response()->json(compact('user'));
    }
}
