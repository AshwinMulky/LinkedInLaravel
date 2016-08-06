<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\User;
use App\Http\Models\Company;
use App\Http\Models\User_Skill;
use App\Http\Models\User_Education;
use App\Http\Models\User_Company;
use Log;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;


class JWTAuthenticationController extends Controller
{

    public function signout(Request $request)
    {
       try{

        $user = \JWTAuth::parseToken()->toUser();

        \JWTAuth::invalidate(\JWTAuth::getToken());

        $user->online = false;
        $user->save();

       }//TokenBlacklistedException
       catch (TokenBlacklistedException $e) {
          // something went wrong
          return response()->json(['error' => 'you have already been signed out'], 500);
        }

        return response()->json(['success' => 'you are signed out'], 200);

    }

     public function authenticate(Request $request)
    {
    	$credentials = $request->only('email', 'password');

        try {

          /// \Config::set('jwt.user' , "App\User");
            // verify the credentials and create a token for the user
            if (! $token = \JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = \JWTAuth::authenticate($token);

        $user->online = true;
        $user->save();

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function signup(Request $request)
    {

         $validation = \Validator::make($request->all(), [
              'user_type'=> 'required|in:Trainer,Company,User',
              'password' => 'required',

              'user_name' => 'required_if:user_type,Trainer',
              'first_name' => 'required_with:user_name',
              'last_name'=> 'sometimes|required_with:user_name',
              'email' => 'required_with:user_name|email|unique:users,email',
              'dob' => 'required_with:user_name',
              'sex' => 'required_with:user_name|in:M,F,NA',
              'nationality'=> 'sometimes|required_with:user_name',              
              'phone_number_mobile' => 'sometimes|required_with:user_name|digits_between:10,12',
              'phone_number_home' => 'sometimes|required_with:user_name|digits_between:10,12',
              'phone_number_work' => 'sometimes|required_with:user_name|digits_between:10,12',
              'twitter_account_name1'=> 'sometimes|required_with:user_name',
              'twitter_account_name2'=> 'sometimes|required_with:user_name',

              'company_name' => 'required_if:user_type,Company',
              'company_type'=> 'sometimes|required_with:company_name',
              'website_url' => 'sometimes|required_with:company_name',
              'industries'=> 'sometimes|required_with:company_name',
              'company_phone1' => 'sometimes|required_with:company_name|digits_between:10,12',
              'company_phone2' => 'sometimes|required_with:company_name|digits_between:10,12',
              'company_fax' => 'sometimes|required_with:company_name',
              'employee_count_range'=> 'sometimes|required_with:company_name',
              'specialties'=> 'sometimes|required_with:company_name',
              'locations' => 'required_with:company_name',
              'description'=> 'sometimes|required_with:company_name',
              'stock_exchange'=> 'sometimes|required_with:company_name',
              'founded_year'=> 'sometimes|required_with:company_name',
          ]);
         

         if($validation->fails())
         {
            return $validation->errors();
         }

        $password = bcrypt($request->password);

        $signupdata = $request->except('password');

        $signupdata['password'] = $password;

           try {
               
               $user = User::create($signupdata);

               //different api calls are provided for the below updates

               /*if(!empty($request->skills))
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
               }*/

           } catch (Exception $e) {
               return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
           }

           $user->online = true;
           $user->save();

           $token = \JWTAuth::fromUser($user);

           return response()->json(compact('token'));
    }

}
