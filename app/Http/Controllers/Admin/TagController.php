<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\DiseaseCategory;

class TagController extends Controller
{
      public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }


    // function which return all doctor fields (dcagegories) and form to insert the categories from
    public function tags(){
    	$tags = DiseaseCategory::orderBy("created_at","desc")->paginate(40);
    	return view("admin.tags",compact("tags"));
    }

    // function to delete the doctor categories
    public function deleteTags(Request $request){
    	$tagIds = $request->tagIds;
    	foreach($tagIds as $id){
    		DiseaseCategory::find($id)->delete();
    	}
    	if($request->ajax()){
    		return response()->json(["ids"=>$request->tagIds]);
    	}else{
    		return back()->with("success","seccessfully Deleted");
    	}
    }

    //function which store the dcategories for doctors
    public function storeTags(Request $request){

        $validator = Validator::make($request->all(),[
            "category" => "bail|required|string|min:3|max:60|unique:disease_categories,category",
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
        
       $insert = DiseaseCategory::create(["category"=>$request->category,"createdBy"=>Auth::user()->username]);
       $categoryInserted = DiseaseCategory::latest("id")->first();
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

    // edit function beggining
    public function edit(Request $request){
        $tag = DiseaseCategory::find($request->id);
        return response()->json(["category"=>$tag]);
    }

    // update function beggining
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            "category" => "bail|required|string|min:3|max:60|unique:disease_categories,category",
        ],[
            "category.required" => "The field can not be empty",
            "category.unique"=> "The category name already exists",
        ]);

        if($validator->fails()){
            // if($request->ajax()){
                return response()->json(["errors"=>$validator->errors()]);
            // }
        }
        $category = DiseaseCategory::find($request->tag_id);
        $updated = $category->update(["category"=>$request->category,"updatedBy"=>Auth::user()->username]);
        $updatedCat =  DiseaseCategory::find($request->tag_id);
        $createDate = $updatedCat->created_at->format("Y-M-d");
        $updateDate = $updatedCat->updated_at->format("Y-M-d"); 
        $registered = $updatedCat->posts()->count() + $updatedCat->questions()->count(); 
        if($updated){
            return response()->json(["data"=>$category,"createDate"=>$createDate,"updateDate"=>$updateDate,"registered"=>$registered]);
        }
    }




}
