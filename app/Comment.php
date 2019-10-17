<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /*
	 	to avoid mass assignment 
	*/
    protected $fillable = [
    	"to_type",
    	"to_id"
    ];
}