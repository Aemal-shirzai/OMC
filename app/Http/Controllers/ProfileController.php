<?php

namespace App\Http\Controllers;
use App\Post;
use App\Account;
use App\Comment;
use Illuminate\Http\Request;
use App\Doctor;
use Illuminate\Support\Facades\Auth;
use App\commentReply;

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
        // foreach($achievements = $user->owner->achievements()->orderBy("created_at","desc")->get() as $a){
        //     $date = explode("-",$a->ach_date);
        //     $n = explode(" ",$date[2]);
        //     echo $n[0];
        // }
        if($user){
            if($user->owner_type == "App\NormalUser"){
                $questions = $user->owner->questions()->orderBy("created_at","desc")->get();
                $favQuestions =  $user->owner->favoriteQuestions("created_at")->orderBy("favorites.created_at","desc")->get();
                $favPosts =  $user->owner->favoritePosts()->orderBy("favorites.created_at","desc")->get();
                return view('profile',compact("user","questions","favQuestions","favPosts"));
            }else{
               $posts = $user->owner->posts()->orderBy('created_at',"desc")->get();
               $achievements = $user->owner->achievements()->orderBy("created_at","desc")->get();
               return view('profile',compact("user","posts","achievements"));
            }
        }else{
            return abort(404);
        }
    }
    // main function end

}
// controller end