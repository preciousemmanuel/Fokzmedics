<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AutomatedDrug;
use App\Bank;
use App\Drug;
use App\CentralDrug;
use App\Centraltest;
use App\Specialization;
use App\Freelancercategory;
use App\DrugTransaction;
use App\Purse;
use App\Book;
use App\Upload;
use App\Imports\DrugsImport;
use App\Imports\TestsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Notifications\CreateAdminNotify;
use Illuminate\Support\Facades\Hash;

// use App\Http\Requests\Pharmacy\UpdateProfileRequest;
// use App\Http\Requests\Pharmacy\AddDrugRequest;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['verifyType:6']);
        //$this->middleware(['isUpdated:3'])->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function centralDrug(){
        $drugs=CentralDrug::simplePaginate(20);
    	return view('admin.centralDrug')->with("drugs",$drugs);
    }
    public function centralTest(){
        $tests=Centraltest::simplePaginate(20);
        return view('admin.centralTest')->with("tests",$tests);
    }

     public function importDrugs(Request $request) 
    {
    	if ($request->hasFile('file')){
        Excel::import(new DrugsImport,request()->file('file'));
        session()->flash('success',"Central drug added successfully");
        return back();
    	}
    	session()->flash('error',"Must be an Excel file");
        return back();
           
        
    }

    public function prescriptions(){
        $prescriptions=Upload::simplePaginate(7);
       
        return view('admin.prescriptions')->with('prescriptions',$prescriptions);
    }
     public function importTests(Request $request) 
    {
        if ($request->hasFile('file')){
        Excel::import(new TestsImport,request()->file('file'));
        session()->flash('success',"Test added successfully");
        return back();
        }
        session()->flash('error',"Must be an Excel file");
        return back();      
    }
    // public function profile(){
    //     //$banks=DB::table('banks')->get();
    //     return view('pharmacy.profile')
    //     ->with('banks',Bank::all())
    //     ->with('user',auth()->user());
    // }

    // public function updateProfile(UpdateProfileRequest $request, User $user)
    // {  
    //     $data=$request->only(['fullname','phone','business_name','address','licence_number','supretendent_name','education','accnt_name','accnt_num','accnt_bank','consult_type','consulting_fee','hospital_address']);
    //     if ($request->hasFile('image')) {
    //         $image=$request->image->store('upload');
    //         $user->deleteImage();
    //         $data['image']='storage/'.$image;
    //     }
    //      if (!empty($request->state)|| $request->state!="Select State") {
    //         $data['state']=$request->state;
    //     }
    //      if (!empty($request->city)|| $request->city!="Select City") {
    //         $data['city']=$request->city;
    //     }
    //     $data['updated']=1;
      
    //     $user->update($data);

    //     session()->flash('success',"Your profile is updated successfully");
    //     if (empty($user->licence)) {
    //         return redirect()->route('pharmacy.licence');
    //     }
    //     return redirect()->route('pharmacy.profile');
        
    // }
    //this conert addon money of 16percent to the actual money
    public function deduceAmount($amount){
        $percent=(13.795/100)*$amount;
        if (is_float($amount)) {
           return $amount-round($percent,1);
        } else {
           return $amount-round($percent);
        }
        
        
    }
    public function doctorDrugAmountShare($amount){
        $percent=(8/100)*$amount;
        return $percent;
    }

    
    public function hypaacCommission($amount){
        $percent=(2.5/100)*$amount;
        return $percent;
    }
    public function drugReferalCommission($amount){
       $percent=(1/100)*$amount;
        return $percent;
    }
    public function bookReferalCommission($amount){
       $percent=(3/100)*$amount;
        return $percent;
    }

    public function getUserByEmail($email){
        return User::where("email",$email)->first();
    }
    public function getReferal($user_id){
        return User::where("email",$email)->first();
    }

    //when adminclicks on a drug transaction for payment
    public function disbuseDrugPayment(Request $request){
        
        //$setting=Setting::find(1);
        return DB::transaction(function() use ($request){
            $transaction_id=$request->transaction;
            DrugTransaction::where("id",$transaction_id)->update(["status"=>4]);
            $transaction=DrugTransaction::find($transaction_id);
            $totalAmount=$transaction->amount;
            //100 naira is d percentage added for deleivery fee by admin
            //$deliveryFee=$setting->deliveryFee-100;
            $deliveryFee=400;

            $drugAmount=($transaction->delivery)?$totalAmount-$deliveryFee:$totalAmount;
            //amount without addons
            $actualAmount=$this->deduceAmount($drugAmount);

            $doctorCommision=$this->doctorDrugAmountShare($actualAmount);
            $hypaacAmount=$this->hypaacCommission($actualAmount);
            $referal=$this->drugReferalCommission($actualAmount);

            //credit pharmacy
            Purse::insert([
                "user_id"=>$transaction->pharmacy_id,
                "amount"=>$actualAmount,
                "reason"=>"Drug purchase",  
            ]);

            //credit doctor
            Purse::insert([
                "user_id"=>$transaction->doctor_id,
                "amount"=>$doctorCommision,
                "reason"=>"Drug Prescription",
            ]);

            //credit hypaac
            //select usertable to get hypaac id 
            $hypaac=User::where("type",7)->first();
            Purse::insert([
                "user_id"=>$hypaac->id,
                "amount"=>$hypaacAmount,
                "reason"=>"Drug purchase",
            ]);

            //check if patient is refered
            $patient_referal_email=User::find($transaction->patient_id)->referal;
            if (!empty($patient_referal_email)) {
                $patient_referal=$this->getUserByEmail($patient_referal_email);
                 Purse::insert([
                "user_id"=>$patient_referal->id,
                "amount"=>$referal,
                "reason"=>"Referal bonus",
            ]);
            }

            //check if doctor is refered
             $doctor_referal_email=User::find($transaction->doctor_id)->referal;
            if (!empty($doctor_referal_email)) {
                $doctor_referal=$this->getUserByEmail($doctor_referal_email);
                 Purse::insert([
                "user_id"=>$doctor_referal->id,
                "amount"=>$referal,
                "reason"=>"Referal bonus",
            ]);
            }

            //check if pharmacist is refered
             $pharmacy_referal_email=User::find($transaction->pharmacy_id)->referal;
            if (!empty($pharmacy_referal_email)) {
                $pharmacy=$this->getUserByEmail($pharmacy_referal_email);
                 Purse::insert([
                "user_id"=>$pharmacy->id,
                "amount"=>$referal,
                "reason"=>"Referal bonus",
            ]);
            }

             return response()->json(["status"=>true,'message' => 'Success']);


        });
    } 
    //when adminclicks on a book transaction for payment
    public function disbuseBookingPayment(Request $request){
        
        //$setting=Setting::find(1);
        return DB::transaction(function() use ($request){
            $book_id=$request->book;
            Book::where("id",$book_id)->update(["status"=>4]);
            $book=Book::find($book_id);
            $totalAmount=$book->amount;
            //100 naira is d percentage added for deleivery fee by admin
            //$deliveryFee=$setting->deliveryFee-100;
           // $deliveryFee=400;

            //$drugAmount=($transaction->delivery)?$totalAmount-$deliveryFee:$totalAmount;
            //amount without addons
            $doctorCommision=$this->deduceAmount($totalAmount);

            // $doctorCommision=$this->doctorDrugAmountShare($actualAmount);
            $hypaacAmount=$this->hypaacCommission($doctorCommision);
            $referal=$this->bookReferalCommission($doctorCommision);

            

            //credit doctor
            Purse::insert([
                "user_id"=>$book->doctor_id,
                "amount"=>$doctorCommision,
                "reason"=>"Booking fee",
            ]);

            //credit hypaac
            //select usertable to get hypaac id 
            $hypaac=User::where("type",7)->first();
            Purse::insert([
                "user_id"=>$hypaac->id,
                "amount"=>$hypaacAmount,
                "reason"=>"Booking fee",
            ]);

            //check if patient is refered
            $patient_referal_email=User::find($book->patient_id)->referal;
            if (!empty($patient_referal_email)) {
                $patient_referal=$this->getUserByEmail($patient_referal_email);
                 Purse::insert([
                "user_id"=>$patient_referal->id,
                "amount"=>$referal,
                "reason"=>"Referal bonus",
            ]);
            }

            //check if doctor is refered
             $doctor_referal_email=User::find($book->doctor_id)->referal;
            if (!empty($doctor_referal_email)) {
                $doctor_referal=$this->getUserByEmail($doctor_referal_email);
                 Purse::insert([
                "user_id"=>$doctor_referal->id,
                "amount"=>$referal,
                "reason"=>"Referal bonus",
            ]);
            }

             return response()->json(["status"=>true,'message' => 'Success']);


        });
    }

    public function drugRefund(Request $request){
        $transaction_id=$request->transaction;
        DrugTransaction::where("id",$transaction_id)->update(["status"=>3]);
         return response()->json(["status"=>true,'message' => 'Success']);
    }
    public function drugBook(Request $request){
        $book_id=$request->book;
        Drugbook::where("id",$book_id)->update(["status"=>6]);
         return response()->json(["status"=>true,'message' => 'Success']);
    }
     //show patients page
     public function patients(){
        $patients=User::where("type",1)->searchName()->simplePaginate(10);
        return view('admin.patients')
        ->with('patients',$patients);
    }

    public function createAdmin(Request $request){

        $user=User::create([
            "fullname"=>$request->fullname,
            "email"=>$request->email,
            "admin_role"=>$request->admin_role,
            "password"=>Hash::make('1234'),
            "email_verified_at"=>now(),
            "type"=>6
        ]);
        $user->notify(new CreateAdminNotify($user));
        session()->flash('success',"Subadmin created successfully");
        
        return redirect()->back();
    }
    public function subadmins(){
        $admins=User::where("admin_role","!=","")->orderDesc()->simplePaginate(10);
        return view('admin.subadmin')
        ->with('admins',$admins);
    }
    public function showPurse(){

       $purses= DB::select(DB::raw('select SUM(amount) as amount ,fullname,accnt_bank,accnt_num,accnt_name,paid from purses left join users on users.id=purses.user_id where paid=0 group by fullname'));
            // ->leftJoin('users', 'users.id', '=', 'purses.user_id')
            //  ->where('paid', 0)
            //  ->groupBy('fullname')
            // ->get();
       //dd($purses);
        return view('admin.purse')
        ->with('purses',$purses);
    }

    public function doctors(){
        $doctors=User::where("type",2)->searchSpecialization()->searchName()->simplePaginate(10);
        return view('admin.doctors')
        ->with('doctors',$doctors)->with('specializations',Specialization::all());
    }
    public function freelancers(){
        $freelancers=User::where("type",5)->searchSpecialization()->searchName()->simplePaginate(10);
        return view('admin.freelancers')
        ->with('freelancers',$freelancers)->with('category',Freelancercategory::all());
    }
    public function pharmacy(){
        $pharmacys=User::where("type",3)->searchSpecialization()->searchName()->simplePaginate(10);
        return view('admin.pharmacy')
        ->with('pharmacys',$pharmacys);
    }
    public function diagnostic(){
        $diagnostics=User::where("type",4)->searchSpecialization()->searchName()->simplePaginate(10);
        return view('admin.diagnostic')
        ->with('diagnostics',$diagnostics);
    }

     //show drugs page
   
    public function approveUser(Request $request){

        if ($request->type=="approve") {
            User::where("id",$request->user)->update(["approved"=>1]);
        } else {
            User::where("id",$request->user)->update(["approved"=>0]);
        }
        
       return response()->json(['status'=>true]);
    }

    public function drugTransaction(){
        $transactions=DrugTransaction::simplePaginate(10);
       
        return view('admin.drugTransaction')->with('transactions',$transactions);
    } 
    public function bookings(){
        $bookings=Book::where("is_chat",null)->status()->simplePaginate(10);
       
        return view('admin.allBooking')->with('bookings',$bookings);
    }

    public function profile(){
        //$banks=DB::table('banks')->get();
        return view('admin.profile')
      //  ->with('banks',Bank::all())
        ->with('user',auth()->user());
       // ->with('categories',Freelancercategory::all());
    }

     public function updateDrug(Request $request, CentralDrug $drug){
     	//dd($drug);
       $centralDrug=CentralDrug::find($request->drug);
        $tablet_type=empty($request->tablet_type)?$centralDrug->tablet_type:$request->tablet_type;
        $num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
       CentralDrug::where("id",$request->drug)->update([
           "generic_name"=>$request->generic_name,
           "trade_name"=>$request->trade_name,
           //"quantity"=>$request->quantity,
           "price"=>$request->price,
          // "addon_price"=>auth()->user()->payableAmount($request->price),
           "tablet_type"=>$tablet_type,
           "num_tablet"=>$num_tablet,
           "strength"=>$request->strength,
           "dosage_form"=>$request->dosage_form
           ]);
        session()->flash("success","Drug updated successfully");
        return redirect()->back();
    }
     public function updateTest(Request $request, Centraltest $test){
        //dd($drug);
       //$centralDrug=CentralDrug::find($request->drug);
       // $tablet_type=empty($request->tablet_type)?$centralDrug->tablet_type:$request->tablet_type;
       // $num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
       Centraltest::where("id",$request->test)->update([
           "name"=>$request->name,           
           "price"=>$request->price,
           ]);
        session()->flash("success","Updated successfully");
        return redirect()->back();
    }
     public function addCostPrescription(Request $request, Upload $upload){
        //dd($drug);
       //$centralDrug=CentralDrug::find($request->drug);
       // $tablet_type=empty($request->tablet_type)?$centralDrug->tablet_type:$request->tablet_type;
       // $num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
       $upload->update([
           "cost"=>$request->cost,           
           "admin_comment"=>$request->admin_comment,
           ]);
       //add notifcation to patient
        session()->flash("success","Cost sent successfully");
        return redirect()->back();
    }

     public function markPursePaid(Request $request){
        //dd($drug);
       //$centralDrug=CentralDrug::find($request->drug);
       // $tablet_type=empty($request->tablet_type)?$centralDrug->tablet_type:$request->tablet_type;
       // $num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
       Purse::where("paid",0)->update([
           "paid"=>1           
           ]);
        //session()->flash("success","Users paid successfully");
        return response()->json(["status"=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
