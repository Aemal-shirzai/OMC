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

        $followers = $doctor->followed()->count();
        $doctor->update(["followers"=>$followers]);
    }
// End of the function responsible for managing normal user following doctors 

// Beggining of the function responsible for removing followers by doctors
    public function removeFollower(Request $request){

        //grab follwer (Normal user)
        $follower = NormalUser::findOrFail($request->follower_id);

        // current user
        $user = Auth::user();

        // The current user should be only Dcoor
        if($user->owner_type != "App\Doctor"){
            ///// mssage here will add later on some error return
        }


        // if the that user is in the list of the current authinticated doctor follower list
        if($user->owner->followed()->where("normal_users.id",$request->follower_id)->first()){
            // Then remove that user from the current doctor follwing list
            $user->owner->followed()->detach($follower);

            $followers = $user->owner->followed()->count();
            $user->owner->update(["followers"=>$followers]);
        }else{
            /// if not in the list then return some error message
        }
    }
// End of the function responsible for removing followers by doctors



} // End of controller