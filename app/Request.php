<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //this is for chat request
    public function freelancer(){
    	return $this->belongsTo(User::class,'freelancer_id');
    }
    public function patient(){
    	return $this->belongsTo(User::class,'patient_id');
    }
}
