<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    // this model is for Advertisemets
   
   /**
     * The attributes that are mass assignable.
     */
	 protected $fillable = [
	 	"title",
	 	"content",
	 	"achivement_date"
	 ];

}
