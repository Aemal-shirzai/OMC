<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Advertisement;
class AdvertisementCategory extends Model
{
    // this model is for advertisemnts categories
   
   	/**
     * The attributes that are mass assignable.
     */
	 protected $fillable = [
	 	"category"
	 ];

	 // relationship with advertisements table
	 public function advertisements(){
	 	return $this->hasMany(Advertisement::class,"advertisement_category_id");
	 }
}
