<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
class Doctor extends Model
{
    /*
	 	to avoid mass assignment 
	*/

    protected $fillable = [
    	"fullName",
    	"status",
    	"province",
    	"district",
    	"street",
    	"gender",
    	"DateOfBirth"
    ];

    /*
        Relationship with accounts
    */

    public function account(){
        return $this->morphOne(Account::class,"owner");
    }
}
