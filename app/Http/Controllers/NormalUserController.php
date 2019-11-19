<?php

namespace App\Http\Controllers;

use App\NormalUser;
use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NormalUserController extends Controller
{

    public function __construct(){
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\NormalUser  $normalUser
     * @return \Illuminate\Http\Response
     */
    public function show(NormalUser $normalUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NormalUser  $normalUser
     * @return \Illuminate\Http\Response
     */
    public function edit(NormalUser $normalUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NormalUser  $normalUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NormalUser $normalUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NormalUser  $normalUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(NormalUser $normalUser)
    {
        //
    }


// function responsible for managing normal user following doctors
    public function DoctorFollow(Request $request){

        // grab doctor
        $doctor = Doctor::findOrFail($request->doctor_id);

        // current user
        $user = Auth::user();

        // The current user should be only normal user
        if($user->owner_type != "App\NormalUser"){
            ///// mssage here will add later on some error return
        }

        // to check if the user is already following the doctor
        if($user->owner->following()->where("doctors.id",$request->doctor_id)->first()){
            // then remove the doctor from the following list
            $user->owner->following()->detach($doctor);
        }else{ // if the doctor is not already followed by the normal user
            $user->owner->following()->save($doctor);
        }
    }
// End of the function responsible for managing normal user following doctors 

} // End of controller
