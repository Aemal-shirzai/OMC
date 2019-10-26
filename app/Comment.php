<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"to_type",
    	"to_id"
    ];
}
