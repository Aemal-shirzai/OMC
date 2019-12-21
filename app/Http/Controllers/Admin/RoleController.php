<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Role;

class RoleController extends Controller
{

	public function __construct(){
    	return $this->middleware(["auth","isAdmin"]);
    }


    // function which return all roles and form to insert the roles from
    public function roles(){
    	$roles = Role::orderBy("created_at","desc")->paginate(20);
    	return view("admin.roles",compact("roles"));
    }


    // function to delete the doctor categories
    public function deleteRoles(Request $request){
    	$roleIds = $request->roleIds;
    	foreach($roleIds as $id){
    		Role::find($id)->delete();
    	}
    	if($request->ajax()){
    		return response()->json(["ids"=>$request->roleIds]);
    	}else{
    		return back()->with("success","seccessfully Deleted");
    	}
    }


    //function which store the dcategories for doctors
    public function storeRoles(Request $request){
        $validator = Validator::make($request->all(),[
            "role" => "bail|required|string|min:3|max:60|unique:roles,role",
        ],[
            "role.required" => "The field can not be empty",
            "role.unique"=> "The role name already exists",
        ]);

        if($validator->fails()){
            if($request->ajax()){
                return response()->json(["errors"=>$validator->errors()]);
            }else{
                return back()->withInput()->withErrors($validator->errors());
            }
        }
        
       $insert = Role::create(["role"=>$request->role,"createdBy"=>Auth::user()->username]);
       $roleInserted = Role::latest("id")->first();
       $createDate = $roleInserted->created_at->format("Y-M-d");
       $updateDate = $roleInserted->updated_at->format("Y-M-d"); 

       if($insert){
            if($request->ajax()){
                return response()->json(["data"=>$roleInserted,"createDate"=>$createDate,"updateDate"=>$updateDate]);
            }else{
                return back()->with("success","Role Added!");
            }
       }
    }

    // edit function beggining
    public function edit(Request $request){
        $role = Role::find($request->id);
        return response()->json(["role"=>$role]);
    }

     // update function beggining
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            "role" => "bail|required|string|min:3|max:60|unique:roles,role",
        ],[
            "role.required" => "The field can not be empty",
            "role.unique"=> "The role name already exists",
        ]);

        if($validator->fails()){
            // if($request->ajax()){
                return response()->json(["errors"=>$validator->errors()]);
            // }
        }
        $role = Role::find($request->role_id);
        $updated = $role->update(["role"=>$request->role,"updatedBy"=>Auth::user()->username]);
        $updatedRole =  Role::find($request->role_id);
        $createDate = $updatedRole->created_at->format("Y-M-d");
        $updateDate = $updatedRole->updated_at->format("Y-M-d"); 
        $registered = $updatedRole->users()->count();
        if($updated){
            return response()->json(["data"=>$role,"createDate"=>$createDate,"updateDate"=>$updateDate,"registered"=>$registered]);
        }
    }
    
}
