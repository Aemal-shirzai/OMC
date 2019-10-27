<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
	/**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"fullName",
    	"phoneNumber",
    	"emailAddress",
        "senderUsername",
    	"message"
    ];
}
