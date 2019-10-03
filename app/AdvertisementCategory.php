<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementCategory extends Model
{
    // this model is for advertisemnts categories
    /*
	   to avoid mass assignment
    */
	 protected $fillable = [
	 	"category"
	 ];

}
