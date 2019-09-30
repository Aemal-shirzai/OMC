<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseCategory extends Model
{
	/*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"category",
    ];
}
