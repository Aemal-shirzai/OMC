<?php

namespace App\Http\Controllers;
use App\Post;
use App\Account;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except("index");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($username)
    {

        $user = Account::where("username",$username)->first();
        if($user){
            return view('profile',compact("user"));
        }else{
            return abort(404);
        }
    }
}
