<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Validator;
// use App\Advertisement;
use App\AdvertisementCategory;
class AdvertisementController extends Controller
{
    public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }

    public function index(){
    	$categories = AdvertisementCategory::latest()->get();
    	return view("admin.adds",compact("categories"));
    }

    // adding ads category
    public function storeAdsCat(Request $request){
    	$validator = Validator::make($request->all(),[
            "category" => "bail|required|string|min:3|max:60|unique:advertisement_categories,category",
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
        
       $insert = AdvertisementCategory::create(["category"=>$request->category]);
       $categoryInserted = AdvertisementCategory::latest("id")->first();

        if($insert){
            if($request->ajax()){
                return response()->json(["data"=>$categoryInserted]);
            }else{
                return back()->with("catSuccess","Category Added!");
            }
        }
    }

    // return data for edit categoyr{
    public function editAdsCat(Request $request){
        $category = AdvertisementCategory::find($request->id);
        return response()->json(["category"=>$category]);
    }

    // updateing ads category
    public function updateAdsCat(Request $request){
        $validator = Validator::make($request->all(),[
            "category" => "bail|required|string|min:3|max:60|unique:advertisement_categories,category",
        ],[
            "category.required" => "The field can not be empty",
            "category.unique"=> "The category name already exists",
        ]);

        if($validator->fails()){
            if($request->ajax()){
                return response()->json(["errors"=>$validator->errors()]);
            }
        }

        $category = AdvertisementCategory::find($request->cat_id);
        $updated = $category->update(["category"=>$request->category]);
        $updatedCat =  AdvertisementCategory::find($request->cat_id);
        if($updated){
            return response()->json(["data"=>$category]);
        }
    }

    // delete ads category 
    public function deleteAdsCat(Request $request){
        $Category = AdvertisementCategory::find($request->id);
        $Category->delete();
    }


}
