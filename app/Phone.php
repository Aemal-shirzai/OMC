<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
class Phone extends Model
{
   /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    	"phone",
    ];

    // relationship with normal usr and doctors
    public function owner(){
        return $this->belongsTo(Account::class);
    } 
}
