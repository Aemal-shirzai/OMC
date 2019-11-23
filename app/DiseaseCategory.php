<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
class DiseaseCategory extends Model
{
	/**
     * The attributes that are mass assignable.
    */
    protected $fillable = [
    	"category",
    ];

    // Relationship with posts
    public function posts(){
    	return $this->morphedByMany(Post::class,"owner","post_and_question_category","disease_category_id");
    }

    //will add for question later
}
