<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"title",
    	"content"
    ];
}
