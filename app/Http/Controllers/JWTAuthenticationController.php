<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;


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
              'email' => 'required|email|unique:users,email',
              'dob' => 'required',
              'sex' => 'required',
              'phone' => 'required|digits_between:10,12'
          ]);
         

         if($validation->fails())
         {
            return $validation->errors();
         }

        $password = bcrypt($request->password);

        $signupdata = $request->only('user_name', 'email', 'first_name', 'last_name', 'dob', 'sex', 'nationality', 'phone', 'website');

        $signupdata['password'] = $password;

           try {
               
               $user = User::create($signupdata);

               /*if(!empty($signupdata->skills))
               {
                  $user_skills = User_Skills::create($signupdata->skills);

                  $user->skills()->save($user_skills);
               }*/

           } catch (Exception $e) {
               return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
           }

           $token = \JWTAuth::fromUser($user);

           return response()->json(compact('token'));
    }
}
