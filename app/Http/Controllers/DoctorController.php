<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DoctorAchievementsRequest;
use App\Http\Requests\DoctorAchievementsUpdateRequest;
use Carbon\Carbon;
use App\DoctorAchievement;
class DoctorController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->only(["achAdd","achUpdate","achDelete","achEdit"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::paginate(30);
        return view("doctors.index",compact("doctors"));
    }

    /**
     * order by method
     *
     * @return \Illuminate\Http\Response
     */
    public function sortBy($type){
        if($type == "top"){
            $doctors = Doctor::orderBy("followers","desc")->paginate(30);
        }else if($type == "new"){
            $doctors = Doctor::orderBy("created_at","desc")->paginate(30);   
        }else if($type == "mostposts"){
            $doctors = Doctor::leftJoin("posts","doctors.id","=","posts.doctor_id")->groupBy("doctors.id")->orderBy('posts_count','desc')->selectRaw("doctors.*,count(posts.id) as posts_count")->paginate(30);
        }
        return view("doctors.index",compact("doctors","type"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }



    //  To add achievemnts to docotrs
    public function achAdd(DoctorAchievementsRequest $request)
    {
        // achievements
        if($this->authorize("Doctor_related",Auth::user()))
        {
             // grab the current doctor 
            $user = Auth::user();
            // store the year, month, and day fields in single variable
            $ach_date =  Carbon::createFromDate($request->ach_year,$request->ach_month,$request->ach_day)->format("Y-m-d"); 
             // add the newly created variable of date to request array
            $request->merge(["ach_date"=>$ach_date]);

             // // insert the selected user data
            $achievement = $user->owner->achievements()->create($request->all());
            

            // if photo is selected then add it to a folder and to db aswell
            if($request->hasFile("ach_photo")){
                $photo = $request->file("ach_photo");
                $fullName  = $photo->getClientOriginalName();
                $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
                $extension = $photo->getClientOriginalExtension();
                $nameToBeStored = $onlyName.time(). "." .$extension;
                $folder = "public/images/achievements/";  
                // $photo->move($folder,$nameToBeStored);

                $photo->storeAs($folder,$nameToBeStored);
                $achievement->photos()->create(["path"=>$nameToBeStored,"status"=>"1"]);
            }

            if($achievement){
                return redirect()->route("profile",Auth::user()->username)->with("ach_success","Achievement Added");
            }else{
                return back()->withInput()->with("ach_error","OOps something went wrong try again");;
            }

        }
        // authorization statement end
    } 
    // mian functioin end

    // this function load the the achivement image using ajax
    public function loadAchImage(Request $request){
        $ach = DoctorAchievement::find($request->id);
        $photo = $ach->photos()->where("status",1)->first()->path;
        return response()->json(["photo"=>$photo]);   
    }
    // end of:this function load the the achivement image using ajax
    

    public function achEdit(DoctorAchievement $ach){
        if($this->authorize('doctor_related',Auth::user())){
            if(Auth::user()->isNot($ach->doctor->account)){
                abort(403);
            }
            //  in here we to explode the date stored in the database to year month and day seperratly in order to show that in form in the edit page
            $date = explode("-",$ach->ach_date);
            $year = $date[0];
            $month = $date[1];
            $day = explode(" ",$date[2])[0];

            // add the splited year to the array
            $ach["ach_year"] = $year;

            // in the form  the values are 1 2 3 and so on but the splite month is 01 02 03 04 up to 10 and so on so suppose it is 01 then if we pass 01 in the value in the edit form it will not select that becase it expects 1 not 01. so for that reason we check if the first digit is 0 then just add the second one else add both the 2 digigs
            if($month[0] === "0"){
                $ach["ach_month"] = $month[1];
            }else{
                $ach["ach_month"] = $month;
            }

            // same like month
            if($day[0] === "0"){
                $ach["ach_day"] = $day[1];
            }else{
                $ach["ach_day"] = $day;
            }
            
            

            return view("doctors.achEdit",compact('ach'));
        }
    }

    public function achUpdate(DoctorAchievementsUpdateRequest $request, DoctorAchievement $ach){
        if($this->authorize("doctor_related",Auth::user())){
            if(Auth::user()->isNot($ach->doctor->account)){
                abort(403);
            } 
            
            // store the year, month, and day fields in single variable
            $ach_date =  Carbon::createFromDate($request->ach_year,$request->ach_month,$request->ach_day)->format("Y-m-d"); 
             // add the newly created variable of date to request array
            $request->merge(["ach_date"=>$ach_date]);

            $updated = $ach->update($request->all());

            if($request->hasFile("ach_photo"))
            {
                $photo = $request->file("ach_photo");
                $fullName  = $photo->getClientOriginalName();
                $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
                $extension = $photo->getClientOriginalExtension();
                $nameToBeStored = $onlyName.time(). "." .$extension;
                $folder = "public/images/achievements/";  

                Storage::delete("public/images/achievements/".$ach->photos()->where('status',1)->first()->path);

                $photo->storeAs($folder,$nameToBeStored);
                $ach->photos()->update(["path"=>$nameToBeStored]);
            }
            if($updated){
                 return redirect()->route("profile",Auth::user()->username)->with("achUpdate_success","Achievement updated");
            }else{
                return back()->withInput()->with("ach_error","OOps something went wrong while updating, try again");
            }




        } // authorization statemnt end
    } // main function end

    // function which deletes the achiemvent using ajax request
    public function achDelete(Request $request){
        if($this->authorize("Doctor_related",Auth::user())){
            $ach = DoctorAchievement::find($request->id);

            if(Auth::user()->is($ach->doctor->account)){
                if($ach->photos()->count() > 0){
                    foreach($ach->photos as $photo){
                        Storage::delete("public/images/achievements/".$photo->path);
                        $photo->delete();
                    }
                }
                $ach->delete();
            }
        
        }
        // end of authorization statement
    }
    // End of:function which deletes the achiemvent using ajax request







}
//  main functino end