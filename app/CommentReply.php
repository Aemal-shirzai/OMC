<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"to_id"
    ];
}
