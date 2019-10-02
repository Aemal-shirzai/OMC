<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostAndQuestionCategory extends Model
{
    
   // this is pivot table between disease_categories , posts and question polymorphic many to many


   /*
   		table name
   */
   	protected $table = "post_and_question_category";
}
}
