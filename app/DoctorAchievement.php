<?php

namespace App;
use App\Doctor;
use App\Photo;
use Illuminate\Database\Eloquent\Model;

class DoctorAchievement extends Model
{
	// this model is for doctor achievements
    
    /**
     * The attributes that are mass assignable.
     */
	 protected $fillable = [
	 	"ach_title",
	 	"ach_content",
	 	"ach_date",
	 	"ach_location"
	 ];

	 // relationship with doctors
	 public function doctor(){
	 	return $this->belongsTo(Doctor::class,"doctor_id");
	 }

	 // relationship with photos
	 public function photos(){
	 	return $this->morphMany(Photo::class,"owner");
	 }
}
