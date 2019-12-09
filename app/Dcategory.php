<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dcategory extends Model
{
   	/**
     * The attributes that are mass assignable.
    */
    protected $fillable = [
    	"category",
    ];



    // relationship with doctors table 
    public function doctors(){
        return $this->belongsToMany(Dcategory::class,"dcategory_doctor","dcategory_id","doctor_id");
    }
}
