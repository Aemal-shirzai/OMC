<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"owner_type",
    	"owner_id",
    	"content"
    ];

    // Relationship with posts  Questions
    public function postQuestionOwner(){
    	return $this->morphTo("","to_type","to_id");
    }

    // Relationship with posts and normal users
    public function doctorNormalUserOwner(){
    	return $this->morphTo("","owner_type","owner_id");
    }

    // Relationship with photos
    public function photos(){
    	return $this->morphMany(Photo::class,"owner");
    }
}
