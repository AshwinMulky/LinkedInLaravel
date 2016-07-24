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

        $signupdata = $request->only('user_name', 'email', 'password', 'first_name', 'last_name', 'dob', 'sex', 'nationality', 'phone', 'website');

           try {
               
               $user = User::create($signupdata);

           } catch (Exception $e) {
               return response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
           }

           $token = \JWTAuth::fromUser($user);

           return response()->json(compact('token'));
    }
}
