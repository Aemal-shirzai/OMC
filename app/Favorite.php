<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
	// this model is used as polymorphic many to many between doctors and users favorite posts and questions
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"fav_type",
    ];
}
