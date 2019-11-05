<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Province;
use App\Doctor;
use App\NormalUser;
class District extends Model
{
     protected $fillable = [
    	"district",
    ];

     // Relationship with provice table
    public function provice(){
    	return $this->belongsTo(Province::class);
    }

    // Relationship with doctors
    public function doctors(){
    	return $this->hasMany(Doctor::class);
    }

    // Relationship with normal users
    public function normalUsers(){
    	return $this->hasMany(NormalUser::class);
    }
}
