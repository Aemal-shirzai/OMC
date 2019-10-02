<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
	// used as polymorphic many to many relationship between  normaluser , doctors , post, question
    /*
	 	to avoid mass assignment 
	*/
    protected $fillable = [
    	"to_type",
    ];
}
