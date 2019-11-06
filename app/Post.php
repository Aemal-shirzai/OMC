<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doctor;
class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
    	"title",
    	"content"
    ];

    // Relationship with doctors
    public function owner(){
    	return $this->belongsTo(Doctor::class,"doctor_id");
    }

    // Relationship with photos
    public function photos(){
        return $this->morphMany(Photo::class,"owner");
    }
}
