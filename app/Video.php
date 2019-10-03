<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /*
	 	avoid mass assignment
    */
	protected $fillable = [
		"path"
	];
}
