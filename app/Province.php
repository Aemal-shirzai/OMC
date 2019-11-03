<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\Province;
use App\District;
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
}
