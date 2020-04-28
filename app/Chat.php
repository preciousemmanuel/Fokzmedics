<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //

    public function book(){
    	return $this->belongsTo(Book::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
    // public function doctor(){
    // 	return $this->belongsTo(Book::class,'docot_id');
    // }
}
