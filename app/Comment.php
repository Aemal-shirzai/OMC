<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;
use App\Account;
use App\CommentReply;
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"account_id",
    	"content",
        "UpVotes",
        "DownVotes",
    ];


    // Relationship with posts and normal users
    public function comment_owner_type(){
    	return $this->morphTo("","to_type","to_id");
    }

   // Relationship with accounts
   public function comment_owner(){
        return $this->belongsTo(Account::class,"account_id");
   }

    // Relationship with photos
    public function photos(){
    	return $this->morphMany(Photo::class,"owner");
    }

    // Relationship with comment_replies table
    public function replies(){
        return $this->hasMany(CommentReply::class);
    }

    // Relationship with accounts table based on vote to comments (plymorphic many to many)
    public function votedBy(){
        return $this->morphToMany(Account::class,"to","votes","","account_id")->withTimeStamps()->withPivot("type");
    }
}
