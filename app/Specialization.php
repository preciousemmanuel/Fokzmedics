<?php

namespace App;



class Specialization extends Model
{
    //

    public function users(){
    	return $this->hasMany(User::class);
    }
}
