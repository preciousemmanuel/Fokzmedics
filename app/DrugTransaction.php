<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class DrugTransaction extends Model
{
    //
    protected $table="transaction_drugs";

    public function patient(){
    	return $this->belongsTo(User::class,'patient_id');
    }
    public function pharmacy(){
    	return $this->belongsTo(User::class,'pharmacy_id');
    }
    public function book(){
    	return $this->belongsTo(Book::class,'book_id');
    }
}

