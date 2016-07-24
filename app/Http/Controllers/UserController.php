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

    	$user->load('educations', 'skills', 'companies');

    	return response()->json(compact('user'));
    }
}
