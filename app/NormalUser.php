<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\Account;
use App\Country;
use App\Province;
use App\District;
use App\Phone;
use App\Photo;
use App\Comment;
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
    	"DateOfBirth",
        "country_id",
        "province_id",
        "Bio",
        "district_id"
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

    // Relationship with country
    public function country(){
        return $this->belongsTo(Country::class);
    } 

    // Relationship with province
    public function province(){
        return $this->belongsTo(Province::class);
    } 
    
    // Relationship with district
    public function district(){
        return $this->belongsTo(District::class);
    } 
}
