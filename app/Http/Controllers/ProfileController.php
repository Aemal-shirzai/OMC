<?php

namespace App\Http\Controllers;

use App\Post;
use App\Account;
use App\Comment;
use App\Doctor;
use App\commentReply;
use App\Country;
use App\Province;
use App\District;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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


    /**
     * Show the application edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function edit($username){

        // account of user
        $account = Account::where("username",$username)->first();

        // if account is not found then return 404 page
        if(!$account){
            abort(404);
        }

        // if the someone else is trying to edit someonw else profle then unuthorized page is returned
        if($account->isNot(Auth::user())){
            abort(403);
        }

        // user
        $user = $account->owner;
        
        if($user->DateOfBirth){
            //  in here we to explode the date stored in the database to year month and day seperratly in order to show that in form in the edit page
            $date = explode("-",$user->DateOfBirth);
            $year = $date[0];
            $month = $date[1];
            $day = explode(" ",$date[2])[0];
            // add the splited year to the array
            $user["year"] = $year;
            // in the form  the values are 1 2 3 and so on but the splite month is 01 02 03 04 up to 10 and so on so suppose it is 01 then if we pass 01 in the value in the edit form it will not select that becase it expects 1 not 01. so for that reason we check if the first digit is 0 then just add the second one else add both the 2 digigs
            if($month[0] === "0"){
                $user["month"] = $month[1];
            }else{
                $user["month"] = $month;
            }
            // same like month
            if($day[0] === "0"){
                $user["day"] = $day[1];
            }else{
                $user["day"] = $day;
            }
        }else{
            $user["year"] = 1;
            $user["month"] = 1;
            $user["day"] = 1;
        }
        
        $countries = Country::pluck("country","id");         // inorder to access it inside country select field
        $latestCountry = Country::latest("id")->first();     // inorder to check the country loop with, for insied blade.
        $lastestProvince = Province::latest("id")->first(); // inorder to check the province loop with, for insied blade.
        $country_id = $user->country_id;
        $userContryProvinces = Province::where('country_id',$country_id)->pluck("province","id");
        $province_id = $user->province_id;     
        $userProvinceDistricts = District::where('province_id',$province_id)->pluck("district","id");     

        $phone1 = $account->phones()->first();
        $phone2 = $account->phones()->take(1)->skip(1)->first();
        $user['phone1'] = $phone1;
        $user['phone2'] = $phone2;

        return view("auth.edit",compact('account','user','countries','userContryProvinces','userProvinceDistricts','latestCountry','lastestProvince'));
    }


    public function removePhoto(Request $req){

        $account = Account::find($req->account_id);

        if($account->photos()->where("status",1)->first()){
           $photo =   $account->photos()->where("status",1)->first();
           if($account->owner_type == "App\Doctor"){
                Storage::delete("/public/images/doctors/".$photo->path);
           }else{
                Storage::delete("/public/images/normalUsers/".$photo->path);
           }
           
           $photoDelete = $photo->delete();            

           if($photoDelete){
                return response()->json(["successMessage"=>"Photo Removed"]);
           }
        }


    }


}
// controller end