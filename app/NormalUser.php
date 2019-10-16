<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\Account;
class NormalUser extends Model
{
    /*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"fullName",
        "role_id",
    	"status",
    	"province",
    	"district",
    	"street",
    	"gender",
    	"DateOfBirth"
    ];

    /*
        Relationship with roles
    */
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /*
        Relationship with accounts
    */
    public function account(){
        return $this->morphOne(Account::class,"owner");
    }

}
