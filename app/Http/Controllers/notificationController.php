<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class notificationController extends Controller
{
    public function readMark(Request $request){

    	Auth::user()->notifications()->find($request->notification_id)->markAsRead();

    }
}
