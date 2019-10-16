<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NormalUser;
class Role extends Model
{
	/*
	 	to avoid mass assignment 
	*/
    protected $fillable = [
    	"role",
    ];

    /*
	 	relationship with normalusers 
	*/
	public function users(){
		return $this->hasMany(NormalUser::class);
	}
}
