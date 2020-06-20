<?php

namespace App;


class Book extends Model
{
    //

    protected $casts = [
        'start_book_time' => 'datetime',
    ];

    public function doctor(){
    	return $this->belongsTo(User::class,'doctor_id');
    }
    public function patient(){
    	return $this->belongsTo(User::class,'patient_id');
    }
    public function consultType(){
    	return $this->belongsTo(ConsultType::class,'consult_type_id');
    }
    public function drugs(){
        return $this->hasMany(AutomatedDrug::class,'book_id');
    }
    public function tests(){
        return $this->hasMany(AutomatedTest::class,'book_id');
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function scopeStatus($query){
    	$search=request()->query('status');
    	if ($search) {
    		return $query->where('status',$search);
    	}
    	return $query;
    }
    public function scopeOrderDesc($query){
        return $query->orderBy('id','DESC');
    }

    public function drugTranx(){
        return $this->hasOne(DrugTransaction::class,'book_id');
    }



}
