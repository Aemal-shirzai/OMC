<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Doctor;
use App\NormalUser;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     */
	protected $fillable = [
		"path"
	];

	// Relationship with users and doctors and more will be added later
	public function owner(){
		return $this->morphTo("","owner_type","owner_id");
	}
}
