<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
   /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"phone",
    ];

    // relationship with normal usr and doctors
    public function owner(){
        return $this->morphTo("","owner_type","owner_id");
    } 
}
