<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\Dcategory;

class AdminController extends Controller
{
    public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }

    public function index(){
    	return view("admin.dashboard");
    }

}
