<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doctor;
class Dcategory extends Model
{
   	/**
     * The attributes that are mass assignable.
    */
    protected $fillable = [
    	"category",
        "createdBy",
        "updatedBy",
    ];



    // relationship with doctors table 
    public function doctors(){
        return $this->belongsToMany(Doctor::class,"dcategory_doctor","dcategory_id","doctor_id")->withTimeStamps();
    }
}
