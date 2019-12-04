<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use App\Phone;
use App\Country;
use App\Province;
use App\District;
use App\Photo;
use App\Post;
use App\Comment;
use App\NormalUser;
class Doctor extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"fullName",
    	"status",
    	"province",
    	"district",
    	"street",
    	"gender",
    	"DateOfBirth",
        "country_id",
        "province_id",
        "Bio",
        "district_id",
        "followers"
    ];

    /*
        Relationship with accounts
    */

    public function account(){
        return $this->morphOne(Account::class,"owner");
    }

    // Relationship with country
    public function country(){
        return $this->belongsTo(Country::class,"country_id");
    } 

    // Relationship with province
    public function province(){
        return $this->belongsTo(Province::class);
    } 

    // Relationship with district
    public function district(){
        return $this->belongsTo(District::class);
    } 


    // Relationship with posts
    public function posts(){
        return $this->hasMany(Post::class);
    }

    // Relationship with normalusers table based on being followed by them
    public function followed(){
        return $this->belongsToMany(NormalUser::class,"follows","doctor_id","normal_user_id")->withTimeStamps();
    }

}
