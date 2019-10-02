<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
     /*
	 	to avoid mass assignment 
	*/
    protected $fillable = [
    	"to_id"
    ];
}
