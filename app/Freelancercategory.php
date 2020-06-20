<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Freelancercategory extends Model
{
    
    public function freelancers(){
    	return $this->hasMany(User::class,'category_id');
    }
}
