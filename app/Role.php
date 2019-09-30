<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/*
	 	to avoid mass assignment 
	*/
    protected $fillable = [
    	"role",
    ];
}
