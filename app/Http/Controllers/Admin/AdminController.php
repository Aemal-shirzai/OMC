<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Dcategory;

class AdminController extends Controller
{
    public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }


// function which return all doctor fields (dcagegories) and form to insert the categories from
    public function dcategories(){
    	$dcategories = Dcategory::paginate(40);
    	return view("admin.dcategories",compact("dcategories"));
    }
// function to delete the doctor categories
    public function deleteCategories(Request $request){
    	$catIds = $request->catIds;
    	foreach($catIds as $id){
    		Dcategory::find($id)->delete();
    	}
    	if($request->ajax()){
    		return response()->json(["ids"=>$request->catIds]);
    	}else{
    		return back()->with("deleteDone","seccessfully Edited");
    	}
    }



}
