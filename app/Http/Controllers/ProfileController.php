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

        // if(Auth::user()->owner_type == "App\NormalUser"){
        //      $following = Auth::user()->owner->following;
        //      foreach($following as $f){
        //         if($f->account->photos()->where("status",1)->first())
        //             echo $f->account->photos()->where("status",1)->first()->path;  
        //         }
        //      }
        // }
        $user = Account::where("username",$username)->first();
        if($user){
            return view('profile',compact("user"));
        }else{
            return abort(404);
        }
    }
}
