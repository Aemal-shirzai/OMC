<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdvertisementRequest;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Validator;
use Carbon\Carbon;
use App\Advertisement;
use App\AdvertisementCategory;
class AdvertisementController extends Controller
{
    public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }

    public function index(){
    	$categories = AdvertisementCategory::latest()->get();
        $ads_cat = AdvertisementCategory::pluck("category","id");
        $ads = Advertisement::latest()->get();
    	return view("admin.adds",compact("categories","ads_cat","ads"));
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


    // to store advertisement
    public function store(AdvertisementRequest $request){
      // grab the current doctor 
        $user = Auth::user();
        // store the year, month, and day fields in single variable
        $ads_date =  Carbon::createFromDate($request->ads_year,$request->ads_month,$request->ads_day)->format("Y-m-d");

        // find cateogry
        $category= AdvertisementCategory::findOrFail($request->ads_category);
        //creat array
        $data = 
        [
            "title" =>$request->ads_title,
            "content" => $request->ads_content,
            "expire_date" => $ads_date,
            "createdBy" => $user->username,
        ];
        // insert data
        $advertisement= $category->advertisements()->create($data);
        // if photo is selected then add it to a folder and to db aswell
        if($request->hasFile("ads_photo")){
            $photo = $request->file("ads_photo");
            $fullName  = $photo->getClientOriginalName();
            $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $nameToBeStored = $onlyName.time(). "." .$extension;
            $folder = "public/images/advertisements/";  
            // $photo->move($folder,$nameToBeStored);

            $photo->storeAs($folder,$nameToBeStored);
            $advertisement->photos()->create(["path"=>$nameToBeStored,"status"=>"1"]);
        }

        if($advertisement){
            return back()->with("ads_success","Advertisement Added");
        }
     }


    // read more data using ajax
    public function readMore(Request $request){
        $ad = Advertisement::findOrFail($request->id);
        return response()->json(["data"=>$ad]);
    }

    // delet ads
    public function deleteAds(Request $request){
        $ad = Advertisement::findOrFail($request->id);
        if($ad->photos()->count() > 0){
            foreach($ad->photos as $photo){
                Storage::delete("public/images/advertisements/".$photo->path);
                $photo->delete();
            }
               
        }
        $ad->delete();
    }


    // load data of the ads which is to be uupdated
    function edit(Request $request){
        $ad = Advertisement::findOrFail($request->id);

        $date = explode("-",$ad->expire_date);
        $year = $date[0];
        $month = $date[1];
        $day = explode(" ",$date[2])[0];
        // in the form  the values are 1 2 3 and so on but the splite month is 01 02 03 04 up to 10 and so on so suppose it is 01 then if we pass 01 in the value in the edit form it will not select that becase it expects 1 not 01. so for that reason we check if the first digit is 0 then just add the second one else add both the 2 digigs
        if($month[0] === "0"){
            $month = $month[1];
        }else{
            $month = $month;
        }

        // same like month
        if($day[0] === "0"){
            $day = $day[1];
        }else{
            $day = $day;
        }
        
        if($ad->photos()->where("status",1)->first()){
            $path = $ad->photos()->where("status",1)->first()->path;
        }else{
            $path = "empty";
        }
        return response()->json(["data"=>$ad,"year"=>$year,"month"=>$month,"day"=>$day,"path"=>$path]);
    }


    // function to update the adverisemnts
    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'ads_update_title' => "bail|required|max:100",
            'ads_update_content' => "bail|required|max:500",
            'ads_update_category' => "bail|required|integer",
            'ads_update_photo' => "bail|image|max:10240",
            'ads_update_year' => "bail|required|regex:/^[0-9]+$/i",
            'ads_update_month' => "bail|required|regex:/^[0-9]+$/i",
            'ads_update_day' => "bail|required|regex:/^[0-9]+$/i",
        ],[
            'ads_update_title.required' => "The title can  not be empty...",
            'ads_update_title.max' => "Long title not allowed ...",
            'ads_update_title.max' => "Long description  not  allowed ...",
            'ads_update_category.required' => "category is required...",
            'ads_update_category.number' => "Invalid input for cateory ...",
            'ads_update_photo.required' => "Image is required...",
            'ads_update_photo.image' => "Invalid file. Only photos are allowed...",
            'ads_update_photo.max' => "File too large. max 10MB...",
            'ads_update_year.required' => "The year can not be empty ...",
            'ads_update_year.regex' => "Invalid data for year...",
            'ads_update_month.required' => "The month can not be empty ...",
            'ads_update_month.regex' => "Invalid data from month ...",
            'ads_update_day.required' => "The day can not be empty ...",
            'ads_update_day.regex' => "Invalid data from day ...",
        ]);

        if($validator->fails()){
            
            return back()->withInput()->withErrors($validator->errors());
        }


        $ad =Advertisement::findOrFail($request->id);

        // grab the current doctor 
        $user = Auth::user();
        // store the year, month, and day fields in single variable
        $ads_update_date =  Carbon::createFromDate($request->ads_update_year,$request->ads_update_month,$request->ads_update_day)->format("Y-m-d");

    
        //creat array
        $data = 
        [
            "title" =>$request->ads_update_title,
            "content" => $request->ads_update_content,
            "expire_date" => $ads_update_date,
            "updatedBy" => $user->username,
            "advertisement_category_id" => $request->ads_update_category,   
        ];
        // insert data
        $advertisement= $ad->update($data);

           // if photo is selected then add it to a folder and to db aswell
        if($request->hasFile("ads_update_photo")){
            $photo = $request->file("ads_update_photo");
            $fullName  = $photo->getClientOriginalName();
            $onlyName = pathinfo($fullName,PATHINFO_FILENAME);
            $extension = $photo->getClientOriginalExtension();
            $nameToBeStored = $onlyName.time(). "." .$extension;
            $folder = "public/images/advertisements/";  
            // $photo->move($folder,$nameToBeStored);
            if($ad->photos()->count() > 0){
                foreach($ad->photos as $onePhoto){
                    Storage::delete("public/images/advertisements/".$onePhoto->path);
                    $onePhoto->delete();
                }
               
            }

            $photo->storeAs($folder,$nameToBeStored);
            $ad->photos()->create(["path"=>$nameToBeStored,"status"=>"1"]);
        }

        if($advertisement){
            return back()->with("ads_update_success","Seccessfully Updated");
        }else{
            return back()->withInput()->with("ads_update_error","Somthing went wrong try again!");
        }

     }
        
}
