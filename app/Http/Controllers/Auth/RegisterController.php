<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MoreInfoRequest;


use App\Account;
use App\Doctor;
use App\NormalUser;
use App\Role;
use App\Country;
use App\Province;
use App\District;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo(){
        return route("moreInfo.index",Auth::user()->username);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        //to check if the previous url is the register url 
        $this->middleware("checkPreviousUrl:register,moreInfo.index")->only("moreInfoIndex");
        // to check the authentication
        $this->middleware(["auth"])->only(["moreInfoIndex","moreInfoStore"]);
        // to check for guest middleware
        $this->middleware('guest')->except(["moreInfoIndex","moreInfoStore"]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullName' => ['required', 'string', 'max:60'],
            'username' => ['required', 'string', 'min:3','max:20','regex:/^([a-zA-Z]+)([0-9]*)([-._]?)([a-zA-Z0-9]+)$/i','unique:accounts,username'],
            'registerAs' => ['required'],
            'gender' => ['required','regex:/^[0-1]?$/i'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:accounts,email'],
            'password' => ['required', 'string', 'min:8', 'max:60' ,'confirmed'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data["registerAs"] == 0){ // if the user is trying to register as normal users
            $role = Role::findOrFail(2);    // by default add the (normal user) role to the user
            $owner = $role->users()->create([
                'fullName' => $data["fullName"],
                'status' => 1, // by defalut keep the user active 
                'gender' => $data["gender"]
            ]);
        }else{ // if the user is trying to register as doctor
             $owner = Doctor::create([
                'fullName' => $data["fullName"],
                'status' => 0, // by defalut keep the user not active 
                'gender' => $data["gender"]
            ]);
        }

        return $owner->account()->create([ // add data to account table from the account realtionship
            'email' => $data['email'],
            'username' => $data["username"],
            'password' => Hash::make($data['password']),
        ]);
    }


    // This function return the page of more info
    protected function moreInfoIndex($user)
    {    
      
       
        // ot check if the parameter is equal to current user credentials
        if(Auth::user()->username != $user){
            return abort(404);
        }

        $countries = Country::pluck("country","id");         // inorder to access it inside country select field
        $latestCountry = Country::latest("id")->first();     // inorder to check the country loop with, for insied blade.
        $lastestProvince = Province::latest("id")->first(); // inorder to check the province loop with, for insied blade.
        return view("Auth/userExtraInfo",compact("countries","latestCountry","lastestProvince"));
    }

    // This function store mores info to db 
    protected function moreInfoStore(MoreInfoRequest $request)
    {
        // grab the current user 
        $user = Auth::user();
        // store the year, month, and day fields in single variable
        $DateOfBirth =  Carbon::createFromDate($request->year,$request->month,$request->day)->format("Y-m-d"); 
         // add the newly created variable of date to request array
        $request->merge(["DateOfBirth"=>$DateOfBirth]);

        // if photo is selected then add it to a folder and to db aswell
        if($request->hasFile("photo")){
            $photo = $request->file("photo");
            $fullName  = $photo->getClientOriginalName();
            $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $nameToBeStored = $onlyName.time(). "." .$extension;

            if($user->owner_type == "App\Doctor"){
                $folder = "public/images/doctors/";
            }else{
                $folder = "public/images/normalUsers/";
            }   
            // $photo->move($folder,$nameToBeStored);
            $photo->storeAs($folder,$nameToBeStored);
            $user->photos()->create(["path"=>$nameToBeStored,"status"=>"1"]);
        }

        //if phone number is typed then add it to phones table
        if($request->phone != ""){
            $user->phones()->create(["phone"=>$request->phone]);
        }  
 
      
        // // update the selected user data
        $update = $user->owner->update($request->all());
        
        if($update){
            return redirect()->route("profile",Auth::user()->username)->with("sucesss","Your account was created.");
        }else{
            return back()->withInput()->with("error","OOps something went wrong try again");;
        }

    }

} //main class end
