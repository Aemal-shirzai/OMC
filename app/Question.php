<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DiseaseCategory;
use App\NormalUser;
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

    // Relationship with disease category or tags table
    public function tags(){
        return $this->morphToMany(DiseaseCategory::class,"owner","post_and_question_category","","disease_category_id")->withTimeStamps();
    }

    // Relationship with normalusers
    public function owner(){
        return $this->belongsTo(NormalUser::class,"normal_user_id","id");
    }

    // Relationship with photos
    public function photos(){
        return $this->morphMany(Photo::class,"owner");
    }
}
