<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorCategory extends Model
{
    // this is pivot table between dcategories and doctors


   /*
   		table name
   */
   	protected $table = "dcategory_doctor";
}
