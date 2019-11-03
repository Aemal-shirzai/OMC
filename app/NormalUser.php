<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\Account;
class NormalUser extends Model
{
    /**
     * The attributes that are mass assignable.
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

    // Relationship with phone
    public function phones(){
        return $this->morphMany(Phone::class,"owner");
    } 

}
