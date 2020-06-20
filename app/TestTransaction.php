<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class TestTransaction extends Model
{
      protected $table="transaction_tests";

    public function patient(){
    	return $this->belongsTo(User::class,'patient_id');
    }
    public function lab(){
    	return $this->belongsTo(User::class,'lab_id');
    }
    public function book(){
    	return $this->belongsTo(Book::class,'book_id');
    }
}
