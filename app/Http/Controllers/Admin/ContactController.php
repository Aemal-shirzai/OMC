<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\ContactUs;

class ContactController extends Controller
{
    public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }


    public function index(){
    	$messages = ContactUs::orderBy("created_at","desc")->get();
    	return view("admin.messages",compact("messages"));
    }


    public function delete(Request $request){
    	$message = ContactUs::find($request->id);
    	$message->delete();
    }
}
