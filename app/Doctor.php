<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use App\Phone;
class Doctor extends Model
{
    /**
     * The attributes that are mass assignable.
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

    // Relationship with phone
    public function phones(){
        return $this->morphMany(Phone::class,"owner");
    } 
}
