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
            if($user->owner_type == "App\NormalUser"){
                $questions = $user->owner->questions()->latest()->get();
                return view('profile',compact("user","questions"));
            }else{
               $posts = $user->owner->posts()->orderBy('created_at',"desc")->get();
               return view('profile',compact("user","posts"));
            }
        }else{
            return abort(404);
        }
    }
}
