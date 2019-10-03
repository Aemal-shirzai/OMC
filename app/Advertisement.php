<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    // this model is for Advertisemets
    /*
	   to avoid mass assignment
    */
	 protected $fillable = [
	 	"title",
	 	"content",
	 	"achivement_date"
	 ];

}
