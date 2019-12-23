<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
class ContactUs extends Model
{
	/**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"fullName",
    	"phoneNumber",
    	"emailAddress",
    	"message"
    ];

    // relationship with accounts table
    public function owner(){
        return $this->belongsTo(Account::class,"account_id");
    }
}
