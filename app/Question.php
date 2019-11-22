<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
    */
    protected $fillable = [
    	"title",
    	"content",
        "UpVotes",
        "DownVotes",
        "follower",
    ];
}
