<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doctor;
use App\Comment;
use App\Account;
use App\NormalUser;
class Post extends Model
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

    // Relationship with doctors
    public function owner(){
    	return $this->belongsTo(Doctor::class,"doctor_id");
    }

    // Relationship with photos
    public function photos(){
        return $this->morphMany(Photo::class,"owner");
    }

    // Relationship with Comments
    public function comments(){
        return $this->morphMany(Comment::class,"to");
    }


    // Relationship with Accounts Base on Vote up and vote Down (polymorphic many to many)
    public function votedBy(){
        return $this->morphToMany(Account::class,"to","votes","","account_id")->withTimeStamps()->withPivot("type");
    }

    // Relationship with NormalUser table base on added to favorites
    public function favoritedBy(){
        return $this->morphToMany(NormalUser::class,"fav","favorites","","normalUser_id")->withTimeStamps();
    }
}
