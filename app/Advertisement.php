<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdvertisementCategory;
use App\Photo;
class Advertisement extends Model
{
    // this model is for Advertisemets
   
    /**
     * The attributes that are mass assignable.
    */
	protected $fillable = [
	 	"title",
	 	"content",
	 	"expire_date",
	 	"advertisement_category_id",
	 	"createdBy",
	 	"updatedBy"
	];

	// relationship with advertisements table
	public function category(){
	 	return $this->belongsTo(AdvertisementCategory::class,"advertisement_category_id");
	}

	// relationship with photos
	public function photos(){
		return $this->morphMany(Photo::class,"owner");
	}


}
