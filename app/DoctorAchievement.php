<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAchievement extends Model
{
	// this model is for doctor achievements
    
    /**
     * The attributes that are mass assignable.
     */
	 protected $fillable = [
	 	"title",
	 	"content",
	 	"achivement_date"
	 ];

}
