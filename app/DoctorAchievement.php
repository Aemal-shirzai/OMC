<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAchievement extends Model
{
	// this model is for doctor achievements
    /*
	   to avoid mass assignment
    */
	 protected $fillable = [
	 	"title",
	 	"content",
	 	"achivement_date"
	 ];

}
