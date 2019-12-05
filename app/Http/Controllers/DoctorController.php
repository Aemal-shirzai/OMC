<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DoctorAchievementsRequest;
use Carbon\Carbon;
class DoctorController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->only(["achAdd","achUpdate","achDelete"]);
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

    



    public function achUpdate(){
        
    }public function achDelete(){
        
    }






}
//  main functino end