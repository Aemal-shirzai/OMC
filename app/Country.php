<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Province;
use App\Doctor;
use App\NormalUser;
class Country extends Model
{
    protected $fillable = [
    	"country",
    ];

    // Relationship with provinces
    public function provinces(){
    	return $this->hasMany(Province::class);
    }


    // Relationship with doctors
    public function doctors(){
    	return $this->hasMany(Doctor::class);
    } 

    // Relationship with normalUsers
    public function normalUsers(){
    	return $this->hasMany(NormalUser::class);
    } 
}
