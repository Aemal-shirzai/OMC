<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\Dcategory;

class AdminController extends Controller
{
    public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }


// function which return all doctor fields (dcagegories) and form to insert the categories from
    public function dcategories(){
    	$dcategories = Dcategory::orderBy("created_at","desc")->paginate(40);
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
//function which store the dcategories for doctors
    public function storeCategories(Request $request){

        $validator = Validator::make($request->all(),[
            "category" => "bail|required|string|min:3|max:60|unique:dcategories,category",
        ],[
            "category.required" => "The field can not be empty",
            "category.unique"=> "The category name already exists",
        ]);

        if($validator->fails()){
            if($request->ajax()){
                return response()->json(["errors"=>$validator->errors()]);
            }else{
                return back()->withInput()->withErrors($validator->errors());
            }
        }
        
       $insert = Dcategory::create(["category"=>$request->category,"createdBy"=>Auth::user()->username]);
       $categoryInserted = Dcategory::latest("id")->first();
       $createDate = $categoryInserted->created_at->format("Y-M-d");
       $updateDate = $categoryInserted->updated_at->format("Y-M-d");
       if($insert){
            if($request->ajax()){
                return response()->json(["data"=>$categoryInserted,"createDate"=>$createDate,"updateDate"=>$updateDate]);
            }else{
                return back()->with("success","Category Added!");
            }
       }

    }


}
