<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    //
    function __construct()
    {
    	$this->middleware('jwt.auth');
    }

    public function index()
    {
    	$user = \JWTAuth::parseToken()->toUser();

    	return $this->getUserDetails($user);
    }
}
