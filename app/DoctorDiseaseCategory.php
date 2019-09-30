<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorDiseaseCategory extends Model
{
     // this is pivot table between disease_categories and doctors


   /*
   		table name
   */
   	protected $table = "disease_category_doctor";
}
