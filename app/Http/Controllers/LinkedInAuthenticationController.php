<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

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

       $token = \JWTAuth::fromUser($user);

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

       /* return User::create([
            'linkedin_id' => $linkedinUser->getId(),
            'name' => $linkedinUser->getName(),
            'email' => $linkedinUser->getEmail(),
        ]);*/
    }
}
