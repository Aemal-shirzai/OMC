<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     */
	protected $fillable = [
		"path",
		"status"
	];

	// Relationship with users and doctors and more will be added later
	public function owner(){
		return $this->belongsTo(Account::class);
	}
}
