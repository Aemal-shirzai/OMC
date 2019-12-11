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
use App\Dcategory;

use Validator;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Http\Requests\usersUpdateRequest;
use App\Http\Requests\usersAccountUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
        if($user)
        {
            if($user->owner_type == "App\NormalUser")
            {
                $questions = $user->owner->questions()->orderBy("created_at","desc")->get();
                $favQuestions =  $user->owner->favoriteQuestions("created_at")->orderBy("favorites.created_at","desc")->get();
                $favPosts =  $user->owner->favoritePosts()->orderBy("favorites.created_at","desc")->get();
                return view('profile',compact("user","questions","favQuestions","favPosts"));
            }
            else
            {
               $posts = $user->owner->posts()->orderBy('created_at',"desc")->get();
               $achievements = $user->owner->achievements()->orderBy("created_at","desc")->get();
               return view('profile',compact("user","posts","achievements"));
            }
        }
        else
        {
            return abort(404);
        }
    }
    // main function end


    /**
     * Show the application edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function edit($username)
    {

        // account of user
        $account = Account::where("username",$username)->first();
        // All doctors Categories
        $categories = Dcategory::all();

        // if account is not found then return 404 page
        if(!$account)
        {
            abort(404);
        }

        // if the someone else is trying to edit someonw else profle then unuthorized page is returned
        if($account->isNot(Auth::user()))
        {
            abort(403);
        }

        // user
        $user = $account->owner;
        
        if($user->DateOfBirth)
        {
            //  in here we to explode the date stored in the database to year month and day seperratly in order to show that in form in the edit page
            $date = explode("-",$user->DateOfBirth);
            $year = $date[0];
            $month = $date[1];
            $day = explode(" ",$date[2])[0];
            // add the splited year to the array
            $user["year"] = $year;
            // in the form  the values are 1 2 3 and so on but the splite month is 01 02 03 04 up to 10 and so on so suppose it is 01 then if we pass 01 in the value in the edit form it will not select that becase it expects 1 not 01. so for that reason we check if the first digit is 0 then just add the second one else add both the 2 digigs
            if($month[0] === "0")
            {
                $user["month"] = $month[1];
            }
            else
            {
                $user["month"] = $month;
            }
            // same like month
            if($day[0] === "0")
            {
                $user["day"] = $day[1];
            }
            else
            {
                $user["day"] = $day;
            }
        }
        else
        {
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

        // grab accoounts phone numbers
        $oPhone = $account->phones()->where('type',1)->first();
        $pPhone = $account->phones()->where('type',0)->first();
        // if  use has a number then access its phone column but if the phone is empty then just send empty to view wit account array
        ($oPhone ? $account['oPhone'] = $oPhone->phone : $account["oPhone"] = $oPhone);
        ($pPhone ? $account['pPhone'] = $pPhone->phone : $account["pPhone"] = $pPhone);

        return view("auth.edit",compact('account','user','countries','userContryProvinces','userProvinceDistricts','latestCountry','lastestProvince','categories'));
    }
    // Edit function end

    // update function  for profile
    public function updateProfile(usersUpdateRequest $request,$account){
        // To validate the country and province part. it means if someone clear the value of country but province will remain so thats what i avoid here
        if($request->country_id == null){
            if($request->province_id != ""){
                return back()->withInput()->with("country_id","You need to select a country first");
            }
            // in this part if someone remove the country and those two other fields will be disabled so they will not be sent and if they are not send thier old values will remain in database and only the country will be updated to null. so here we make sure if the country is null then set those two other fileds to null as well
            $request['province_id'] = null;
            $request['district_id'] = null;
        }
        if($request->province_id == null){
            if($request->district_id != ""){
                return back()->withInput()->with("country_id","You need to select a province first");
            }
            // same as above case but only for provinces and districts
            $request['district_id'] = null;
        }
        // find the account
        $account = Account::find($account);

        // to allow only authorized users it means the loggin user is updaed his/her profile not  someones else
        if($account->is(Auth::user())){
            // store the year, month, and day fields in single variable
            $DateOfBirth =  Carbon::createFromDate($request->year,$request->month,$request->day)->format("Y-m-d"); 
             // add the newly created variable of date to request array
            $request->merge(["DateOfBirth"=>$DateOfBirth]);
            // update the dataase
            $update = $account->owner->update($request->all());

            if($account->owner_type == "App\Doctor"){
                //if it has tags fields 
                if($request->has("fields")){
                    // if the doctor already has fields then remove it and add all new one doesnt matter whether use select new one or not 
                    $account->owner->fields()->sync([]);
                    foreach($request->fields as $field){
                        $field = Dcategory::find($field);
                        $account->owner->fields()->save($field);
                    }
                }else{ // if the user uncheck all of them  then they will not be send or if already doesnt have then it will also not been send then remove it anyway
                     $account->owner->fields()->sync([]);
                }
            } 
            if($update){return back()->with("updateSuccess","Profile Updated seccessfully");}else{ return back()->withInput()->with("updateError","Something went wrong tr again");}
        }else{ // if not authorized then redirct to unauthorized page
            abort(403);
        }
    }
    // End of update function for edit profiel

// Beggining of the funcion for edit account settings
    public function updateAccount(usersAccountUpdateRequest $request, $account){
        
        $account = Account::whereUsername($account)->first();
        if($account->is(Auth::user())){

            if(!empty($request->oPhone)){
               $oPhone = $request->oPhone;
               if($account->phones()->where('type',1)->first()){
                    $account->phones()->where('type',1)->first()->update(['phone'=>$oPhone]);
               }else{
                     $account->phones()->create(['phone'=>$oPhone,"type"=>1]);
               }
            }else{
                if($account->phones()->where('type',1)->first()){
                    $account->phones()->where('type',1)->first()->delete();
               }
            }

            if(!empty($request->pPhone)){
               $pPhone = $request->pPhone;
               if($account->phones()->where('type',0)->first()){
                    $account->phones()->where('type',0)->first()->update(['phone'=>$pPhone]);
               }else{
                     $account->phones()->create(['phone'=>$pPhone,"type"=>0]);
               }
            }else{
                if($account->phones()->where('type',0)->first()){
                    $account->phones()->where('type',0)->first()->delete();
               }
            }
           
            $updateAccount = $account->update($request->all());
           if($updateAccount){return redirect()->route('profile.edit',$account->username)->with("accountUpdateSuccess","Account Settings updaetd");}else{return back()->withInput()->with("accountUpdateError","OOps! someting went, wrong try agian");} 
        }
    }
// End of of the funcion for edit account settings

// function which delete aaccoun
    public function deleteAccount(Request $request){
        $Validator = Validator::make($request->all(),[
            "password" => "bail|required"
        ],[
            "password.required" => "The password can not be empty",
        ]);
        if($Validator->fails()){
            return response()->json(["error"=>$Validator->errors()->all()]);
        }

        $account = Account::find($request->account_id);
        $password = $request->password;

        if($account->is(Auth::user())){
            $password_check = Hash::check($password,$account->password);
            if($password_check){
                
                // delete photos beggining
                if($account->photos()->count() > 0 ){
                     foreach($account->photos as $photo){
                        if($account->owner_type == "App\Doctor"){ Storage::delete('public/images/doctors/'.$photo->path); }
                        else{ Storage::delete('public/images/normalUsers/'.$photo->path); }
                     } 
                }
                // delete notifications
                if($account->notifications()->count() > 0) { $account->notifications()->delete(); } 
                $owner = $account->owner;
                $owner->account()->delete();
                $owner->delete();  

            }
            else{
                return response()->json(["error"=>"Invalid password entered"]);
            }
        }

    }
// End of deleting account


// function which removes the use photo using ajax
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
// remove photo function end

// the function which upload user photo using ajax
   public function uploadPhoto(Request $request){

        $Validator = Validator::make($request->all(),[
            "photo" => "bail|required|image|max:10240",
        ],[
            'photo.required' => "Can not submit empty photo",
            'photo.image'=>"Only photos are allowed...",
            'photo.max' => "File too large. max 10MB...",

        ]);
        
        if($Validator->fails()){
            return response()->json(["error"=>$Validator->errors()->all()]);
        }        

        if($request->hasFile("photo")){
             // get account
            $account = Account::find($request->userId);

            // get photo
            $photo = $request->file("photo");
            $fullName  = $photo->getClientOriginalName();
            $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $nameToBeStored = $onlyName.time(). "." .$extension;


            if($account->owner_type == "App\Doctor"){
                $folder = "public/images/doctors/";
            }else{
                $folder = "public/images/normalUsers/";
            }   
    
            $photo->storeAs($folder,$nameToBeStored);

            // if the user already has a photo
            if($account->photos()->where("status",1)->first()){
                // get that old photo
                $oldPhoto = $account->photos()->where("status",1)->first();
                // if user is doctor then go to doctor folder else get it from normalusers folder
                if($account->owner_type == "App\Doctor"){
                    Storage::delete("/public/images/doctors/".$oldPhoto->path);
                }else{
                    Storage::delete("/public/images/normalUsers/".$oldPhoto->path);
                }

                // after deleting from folders update its path to new path in database witout deleting it
                $newPhoto = $oldPhoto->update(["path"=>$nameToBeStored]);

            }else{ // if the user does not have any photo before
                $newPhoto = $account->photos()->create(["path"=>$nameToBeStored,"status"=>"1"]);                
            }
            // send this owner type to with json so we can diffrentiate the owner to show their photo according to thire type from thier folders
            $ownerType = $account->owner_type;
            return response()->json(["photoPath"=>$nameToBeStored,"owner_type"=>$ownerType]);

        } // end of if thier is a photo in the request 
   
   } // uploading photo function end


}
// controller end