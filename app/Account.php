<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Phone;
use App\Account;
use App\Comment;
 use App\CommentReply;
class Account extends Authenticatable
{
	use Notifiable;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',"owner_id","owner_type"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
        Relationship with normalusers and doctors
    */

    public function owner(){
        return $this->morphTo("","owner_type","owner_id");
    }

    // Relationship with phone table
     public function phones(){
        return $this->hasMany(Phone::class);
    } 

    // Relationship with photos
    public function photos(){
        return $this->morphMany(Photo::class,"owner");
    }

    // Realtionship with comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // Relationship with comment_replies table
    public function replies(){
        return $this->hasMany(CommentReply::class);
    }

}
