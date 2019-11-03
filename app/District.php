<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Province;
class District extends Model
{
     protected $fillable = [
    	"district",
    ];

     // Relationship with provice table
    public function provice(){
    	return $this->belongsTo(Province::class);
    }
}
