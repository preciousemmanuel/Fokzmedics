<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
     protected $table="requests";
       //this is for patient to freelace chat request
    public function freelancer(){
    	return $this->belongsTo(User::class,'freelancer_id');
    }
    public function patient(){
    	return $this->belongsTo(User::class,'patient_id');
    }
}
