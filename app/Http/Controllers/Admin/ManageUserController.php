<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\Doctor;
use App\Dcategory;
use App\Account;
use App\DoctorAchievement;
use App\Post;
use App\Question;

use App\NormalUser;
class ManageUserController extends Controller
{
    public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }

    // return all deactivate doctors
    public function doctors(){
    	$doctors = Doctor::where("status",0)->latest()->get();
    	return view("admin.doctors",compact("doctors"));
    }


// Beggining of the function which retrn the result of the user search using ajax
    public function searchResult(Request $req){
        if($req->type === "name"){
            $doctors = Doctor::where("fullName","like","%$req->data%")->where('status',0)->select("fullName")->distinct()->get();
        }else if($req->type === "username"){
            $doctors = Account::join('doctors',"accounts.owner_id","=","doctors.id")->where("accounts.owner_type","App\Doctor")->where("accounts.username","like","%$req->data%")->where("doctors.status",0)->select("accounts.username")->get();
        }else if($req->type === "field"){
             $doctors = Dcategory::where("category","like","%$req->data%")->select("category")->get();
        }else if($req->type === "location"){
            $doctors = Doctor::where("street","like","%$req->data%")->where('status',0)->select("street")->get();
        }
        if(count($doctors) > 0){
            return response()->json(["resultFound"=>$doctors]);
        }else{
            return response()->json(["resultNotFound"=>"Result Not Found"]);
        }
    }
// End of the function which retrn the result of the user search using ajax


// Beggining of the function which search the doctor
    public function search(Request $req){
        $this->validate($req,[
            "searchFor" => "bail|required|string|max:60",
            "searchType" => "bail|required",
        ]);
        // return $req->searchFor;
        if($req->searchType === "name"){
            $doctors = Doctor::where("fullName",'like',"%$req->searchFor%")->where('status',0)->paginate(30);
        }elseif($req->searchType === "username"){
            $account = Account::where("username",'like',"%$req->searchFor%")->first();
            if($account){
                if($account->owner_type == "App\NormalUser"){
                    return view("admin.doctors")->with("notFound","Not Found!");
                }
                if($account->owner->status == 1){
                return view("admin.doctors")->with("notFound","Not Found!");
                }
                return redirect()->route("profile",$account->username);
            }else{
                $notFound = "Not Found!";
                return view("admin.doctors",compact('notFound'));
            }
            
        }elseif($req->searchType === "field"){
            $doctors = Doctor::join("dcategory_doctor","doctors.id","=","dcategory_doctor.doctor_id")->join("dcategories","dcategory_doctor.dcategory_id","=","dcategories.id")->where('dcategories.category',"like","%$req->searchFor%")->where("doctors.status",0)->groupBy("doctors.id")->select("doctors.*")->paginate(30);
        }else if($req->searchType === "location"){
            $doctors = Doctor::where("street",'like',"%$req->searchFor%")->where('status',0)->paginate(30);
        }

        return view("admin.doctors",compact("doctors"));
    }
// Beggining of the function which search the doctor

    // function to change the use status
    public function changeStatus(Request $request){
    	if($request->type == "doctor"){
    		$user = Doctor::findOrFail($request->id);
    		if($user->status == 0){
    			$user->update(["status"=>1]);
    			return response()->json(["status"=>"activated"]);
    		}else{
    			$user->update(["status"=>0]);
    			return response()->json(["status"=>"deactivated"]);
    		}

    	}else{

    	}
    }


    // normal user part
    public function nusers(){
        $nusers = NormalUser::where("status",0)->latest()->get();
        return view("admin.nusers",compact("nusers"));
    }


    // Beggining of the function which retrn the result of the user search using ajax
    public function nusersearchResult(Request $req){
        if($req->type === "name"){
            $nusers = NormalUser::where("fullName","like","%$req->data%")->where('status',0)->select("fullName")->distinct()->get();
        }else if($req->type === "username"){
            $nusers = Account::join('normal_users',"accounts.owner_id","=","normal_users.id")->where("accounts.username","like","%$req->data%")->where("accounts.owner_type","App\NormalUser")->where("normal_users.status",0)->select("accounts.username")->get();
        }
        if(count($nusers) > 0){
            return response()->json(["resultFound"=>$nusers]);
        }else{
            return response()->json(["resultNotFound"=>"Result Not Found"]);
        }
    }
// End of the function which retrn the result of the user search using ajax

// Beggining of the function which search the doctor
    public function nuserSearch(Request $req){
        $this->validate($req,[
            "searchFor" => "bail|required|string|max:60",
            "searchType" => "bail|required",
        ]);
        // return $req->searchFor;
        if($req->searchType === "name"){
            $nusers = NormalUser::where("fullName",'like',"%$req->searchFor%")->where("status",)->paginate(30);
        }elseif($req->searchType === "username"){
            // $account = Account::where("username",'like',"%$req->searchFor%")->where('owner_type',"App\NormalUser")->first();
            $account = Account::where("username",'like',"%$req->searchFor%")->first();
            if($account){
                if($account->owner_type == "App\Doctor"){
                    return view("admin.nusers")->with("notFound","Not Found!");
                }
                if($account->owner->status == 1){
                   return view("admin.nusers")->with("notFound","Not Found!");
                }
                return redirect()->route("profile",$account->username);
            }else{
                $notFound = "Not Found!";
                return view("admin.nusers",compact('notFound'));
            }
        }

        return view("admin.nusers",compact("nusers"));
    }
// Beggining of the function which search the doctor




}
