<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Account;
use App\Photo;
class CommentReply extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"account_id",
    	"content"
    ];


    // Relationship with comments Table
    public function comment(){
    	return $this->belongsTo(Comment::class,'comment_id');
    }

    // Relationship with Accounts Table
    public function owner(){
    	return $this->belongsTo(Account::class,'account_id');
    }

    // Relationship with photos table
    public function photos(){
    	return $this->morphMany(Photo::class,"owner");
    }
}
