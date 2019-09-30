<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dcategory extends Model
{
    /*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"category",
    ];
}
