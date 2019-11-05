<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\District;
use App\Doctor;
use App\NormalUser;

class Province extends Model
{
     protected $fillable = [
    	"province",
    ];

    // Relationship with country table
    public function country(){
    	return $this->belongsTo(Country::class);
    }

     // Relationship with districts table
    public function districts(){
    	return $this->hasMany(District::class);
    }

    // Relationship with normalUsers
    public function doctors(){
        return $this->hasMany(Doctor::class);
    } 

    // Relationship with normalUsers
    public function normalUsers(){
        return $this->hasMany(NormalUser::class);
    } 
}
