<?php

namespace App\Http\Controllers;
use App\Post;
use App\Account;
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
        #$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($username)
    {
        // return Auth::user()->postsVotes()->where(["type"=>1,"to_type"=>"App\Post","to_id"=>1])->first();

        $user = Account::where("username",$username)->first();
        if($user){
            return view('profile',compact("user"));
        }else{
            return abort(404);
        }
    }
}
