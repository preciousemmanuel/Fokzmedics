<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Freelancercategory;
use App\Specialization;
use App\Drug;
use App\CentralDrug;
use App\Centraltest;
use Illuminate\Support\Facades\DB;


class WelcomeController extends Controller
{
    //

	public function index(){
		return view('home.index')->with('categories',Freelancercategory::all());
	}
	public function about(){
		return view('home.about');
	}
	public function faq(){
		return view('home.faq');
	}
	public function disclaimer(){
		return view('home.disclaimer');
	}
	public function howWork(){
		return view('home.howWork');
	}
	public function faqDoctor(){
		return view('home.faqDoctor');
	}
	public function faqFreelance(){
		return view('home.faqFreelance');
	}
	public function returnPolicy(){
		return view('home.returnPolicy');
	}
	public function termsCondition(){
		return view('home.termsCondition');
	}
	public function privacyPolicy(){
		return view('home.privacyPolicy');
	}
	public function searchDrug(Request $request){
		$search=$request->input('term');
		$drugs=CentralDrug::where('generic_name','LIKE',"%{$search}%")->get();
		if ($drugs->count()>0) {
			$arr_result=[];
			foreach ($drugs as $key => $drug) {
				
				$arr_result[]=array('label'=>$drug->generic_name,'strength'=>$drug->strength,'dosage_form'=>$drug->dosage_form,'id'=>$drug->id);
			}
			return response()->json($arr_result);
		}
	}


	public function searchTest(Request $request){
		$search=$request->input('term');
		$tests=Centraltest::where('name','LIKE',"%{$search}%")->get();
		if ($tests->count()>0) {
			$arr_result=[];
			foreach ($tests as $key => $test) {
				
				$arr_result[]=array('label'=>$test->name,'id'=>$test->id);
			}
			return response()->json($arr_result);
		}
	}
	public function searchDoctor(Request $request){
		$search=$request->input('term');
		$users=User::approved()->where('fullname','LIKE',"%{$search}%")->where('type','=',2)->get();
		if ($users->count()>0) {
			$arr_result=[];
			foreach ($users as $key => $user) {
				
				$arr_result[]=array('label'=>$user->fullname,'specialization'=>$user->specialization->name,'id'=>$user->id);
			}
			return response()->json($arr_result);
		}
	}

	public function getPractitioner(User $user){
		if($user->type==1 ||$user->type==3||$user->type==4){
			return redirect()->back();
		}
		//dd($user);
		return view('home.show_doctor')->with('user',$user);
	}

	public function listFreelancers($category){
		//$freelancers=$category->freelancers()->approved();
		$cat=Freelancercategory::find($category);
		$freelancers=$cat->freelancers()->simplePaginate(9);
		//dd($cat);
		return view('home.freelancer')->with('category',$cat)->with("freelancers",$freelancers)->with('categories',Freelancercategory::all());
	}
	public function allFreelancers(){
		//$freelancers=$category->freelancers()->approved();
		$freelancers=User::approved()->where('type',5)->simplePaginate(9);
		//dd($cat);
		return view('home.freelancer')->with('freelancers',$freelancers)->with('categories',Freelancercategory::all());
	}
	public function doctors(){
		//$freelancers=$category->freelancers()->approved();
		$doctors=User::approved()->searchDoctorCity()->where("type",2)->simplePaginate(9);
		//dd($cat);
		$city=User::distinct('city')->pluck('city');
		//$city=DB::select(DB::raw("select distinct city from users "));
		//dd($city);
		return view('home.doctors')->with('doctors',$doctors)->with('specializations',Specialization::all())
		->with('city',$city);
	}

	public function doctorSpecializations(Specialization $specialization){
		//$freelancers=$category->freelancers()->approved();
		$doctors=$specialization->users()->approved()->searchDoctorCity()->simplePaginate(9);
		$city=User::distinct('city')->pluck('city');
		//dd($doctors);
		return view('home.doctors')->with('doctors',$doctors)->with('specializations',Specialization::all())->with('specialization',$specialization)
		->with('city',$city);
	}
	// public function allFreelancers(){
	// 	//$freelancers=$category->freelancers()->approved();
	// 	$cat=Freelancercategory::find($category);
	// 	//dd($cat);
	// 	return view('home.freelancer')->with('category',$cat);
	// }

	
}
