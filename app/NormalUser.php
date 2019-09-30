<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NormalUser extends Model
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
