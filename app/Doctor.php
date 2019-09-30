<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"firstName",
    	"lastName",
    	"status",
    	"province",
    	"district",
    	"street",
    	"gender",
    	"DateOfBirth"
    ];
}
