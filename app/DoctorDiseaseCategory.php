<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorDiseaseCategory extends Model
{
     // this is pivot table between disease_categories and doctors


   /**
     * The attributes that are mass assignable.
     */
   	protected $table = "disease_category_doctor";
}
