<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NormalUser;
class Role extends Model
{
	/**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"role",
    	"createdBy",
    	"updatedBy",
    ];

    /*
	 	relationship with normalusers 
	*/
	public function users(){
		return $this->hasMany(NormalUser::class);
	}
}
