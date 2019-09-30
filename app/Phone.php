<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    /*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"phone",
    ];
}
