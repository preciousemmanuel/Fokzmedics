<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purse;

class HypaacController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware(['verifyType:7']);
        //$this->middleware(['isUpdated:3'])->only(['index']);
    }
    public function index()
    {
    	$paid=Purse::where("user_id",auth()->user()->id)->where("paid",1)->get()->sum('amount');
        $pending=Purse::where("user_id",auth()->user()->id)->where("paid",0)->get()->sum('amount');

        return view('hypaac.index')->with("pending",$pending)
        ->with("paid",$paid);
    }

     public function profile(){
        //$banks=DB::table('banks')->get();
        return view('hypaac.profile')
      //  ->with('banks',Bank::all())
        ->with('user',auth()->user());
       // ->with('categories',Freelancercategory::all());
    }
}
