<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementCategory extends Model
{
    // this model is for advertisemnts categories
   
   	/**
     * The attributes that are mass assignable.
     */
	 protected $fillable = [
	 	"category"
	 ];

}
