<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\User_Skill;
use App\User_Education;
use App\User_Company;
use Log;


class JWTAuthenticationController extends Controller
{
     public function authenticate(Request $request)
    {
    	$credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

     public function signup(Request $request)
    {

         $validation = \Validator::make($request->all(), [
              'user_name' => 'required',
              'first_name' => 'required',
              'last_name'=> 'sometimes|required',
              'email' => 'required|email|unique:users,email',
              'dob' => 'required',
              'sex' => 'sometimes|required',
              'nationality'=> 'sometimes|required',
              'user_type'=> 'sometimes|required',
              'phone_number_mobile' => 'digits_between:10,12',
              'phone_number_home' => 'digits_between:10,12',
              'phone_number_work' => 'digits_between:10,12',
              'twitter_account_name1'=> 'sometimes|required',
              'twitter_account_name2'=> 'sometimes|required',
              'password' => 'required'
          ]);
         

         if($validation->fails())
         {
            return $validation->errors();
         }

        $password = bcrypt($request->password);

        $signupdata = $request->only('user_name', 'email', 'first_name', 'last_name', 'dob', 'sex', 'nationality', 'user_type', 'phone_number_mobile', 'phone_number_home', 'phone_number_work', 'twitter_account_name1', 'twitter_account_name2');

        $signupdata['password'] = $password;

           try {
               
               $user = User::create($signupdata);

               if(!empty($request->skills))
               {
                //Log::info($request->skills[0]['skill_name']);
                  foreach ($request->skills as $skill) {
                    $user_skill = User_Skill::create($skill);

                    $user->skills()->save($user_skill);
                  }
                  //
               }

               if(!empty($request->educations))
               {
                  foreach ($request->educations as $education) {
                    $user_education = User_Education::create($education);

                    $user->educations()->save($user_education);
                  }
                  //
               }

               if(!empty($request->companies))
               {
                  foreach ($request->companies as $company) {
                    $user_company = User_Company::create($company);

                    $user->companies()->save($user_company);
                  }
                  //
               }

           } catch (Exception $e) {
               return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
           }

           $token = \JWTAuth::fromUser($user);

           return response()->json(compact('token'));
    }
}
