<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
        /*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"title",
    	"content"
    ];
}
