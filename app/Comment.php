<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;
use App\Account;
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"account_id",
    	"content"
    ];


    // Relationship with posts and normal users
    public function comment_owner_type(){
    	return $this->morphTo("","owner_type","owner_id");
    }

   // Relationship with accounts
   public function comment_owner(){
        return $this->belongsTo(Account::class,"account_id");
   }

    // Relationship with photos
    public function photos(){
    	return $this->morphMany(Photo::class,"owner");
    }
}
