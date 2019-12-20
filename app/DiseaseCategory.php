<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Question;
class DiseaseCategory extends Model
{
	/**
     * The attributes that are mass assignable.
    */
    protected $fillable = [
    	"category",
        "createdBy",
        "updatedBy",
    ];

    // Relationship with posts
    public function posts(){
    	return $this->morphedByMany(Post::class,"owner","post_and_question_category","disease_category_id");
    }

    //relationship with quesitons
    public function questions(){
        return $this->morphedByMany(Question::class,"owner","post_and_question_category","disease_category_id");
    }
}
