<?php

namespace App\Http\Controllers;

use App\ContactUs;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactUsRequest;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("contactUs");    
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsRequest $request)
    {
        if(Auth::check()){
            $contact = Auth::user()->messages()->create($request->all());
        }else{
            $contact = ContactUs::create($request->all());   
        }

        

        if($contact){
            return back()->with("success","We recieved your message.");   
        }else{
            return back()->withInput()->with("error","Oops! something went wrong try again.");   
        }
    }

}
