<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseCategory extends Model
{
	/**
     * The attributes that are mass assignable.
    */
    protected $fillable = [
    	"category",
    ];
}
