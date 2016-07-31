<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Models\User;
use App\Http\Models\LinkedIn_User;

use Socialite;

class LinkedInAuthenticationController extends Controller
{
     /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        /*return Socialite::driver('linkedin')->scopes(['r_basicprofile', 'r_emailaddress', 'rw_company_admin'])->redirect();*/

        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from Linkedin.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        

        try {
            
           $user = Socialite::driver('linkedin')->user();

        } catch (Exception $e) {
            return view('error');
        }

        // $user->token; //Linkedin access token

       $authUser = $this->findOrCreateUser($user);

       $authUser = $this->updateFullProfile($authUser, $user->token);

       $token = \JWTAuth::fromUser($authUser);

       return response()->json(compact('token'));   
    }

     /**
     * Return user if exists; create and return if doesn't
     *
     * @param $linkedinUser
     * @return User
     */
    private function findOrCreateUser($linkedinUser)
    {
        if ($authUser = User::where('linkedin_id', $linkedinUser->id)->first()) {
            return $authUser;
        }

       $user = User::create([
            'user_name' => $linkedinUser->getName(),
            'email' => $linkedinUser->getEmail(),
            'linkedin_id' => $linkedinUser->id
        ]);

        return $user;
    }

    private function updateFullProfile($authUser, $token)
    {

        //update full profile/ all linked in tables

       // $response = $this->linkedInResponse();

        $linkedInUser = Linkedin_User::create([
            'interests' => 'int123'
        ]);

        $authUser->linkedin_profile()->save($linkedInUser);

        return $authUser;
    }

   /* private function linkedInResponse()
    {
        //$response->interests = "interest123";

         $response = (object)array('interests'=>'int123'
            );

        return $response;
    }*/
    
}
