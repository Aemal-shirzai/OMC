<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /*
	 	avoid mass assignment
    */
	protected $fillable = [
		"path"
	];
}
