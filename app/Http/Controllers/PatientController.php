<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AutomatedDrug;
use App\AutomatedTest;
use App\Bank;
use App\User;
use App\Schedule;
use App\BookTransaction;
use App\Book;
use App\DrugTransaction;
use App\TestTransaction;
use App\Chat;
use App\Upload;
use App\Purse;
use App\Events\NewMessage;
use App\Http\Requests\Patients\UpdateProfileRequest;
use App\Http\Requests\Patients\BookDoctorRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Notifications\NewBooking;
use App\Notifications\DrugTransaction as TransactionNotify;
use App\Notifications\PayDrugOnDelivery;
use App\Notifications\TestTransaction as TestTransactionNotify;


class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['verifyType:1','isSetType']);
        //$this->middleware(['isUpdated:1'])->only(['index']);
        $this->middleware('isUpdated:1')->except(['bookingSuccess','storeBookingPayment','showBookingPayment','bookDoctor','profile','updateProfile','uploadLicence','deleteLicence']);
        $this->middleware(['isApproved:1'])->except(['index','profile','updateProfile','uploadLicence','deleteLicence']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('patients.index');
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
    public function profile(){
        $states=DB::table('states')->distinct()->get(['names']);
        return view('patients.profile')
        ->with('banks',Bank::all())
        ->with('states',$states)
        ->with('user',auth()->user());
    }
    public function purse(){
        //$banks=DB::table('banks')->get();
      $paid=Purse::where("user_id",auth()->user()->id)->where("paid",1)->get()->sum('amount');
        $pending=Purse::where("user_id",auth()->user()->id)->where("paid",0)->get()->sum('amount');

        return view('patients.purse')
        ->with('paid',$paid)
        ->with('pending',$pending);
    }
     public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        $data=$request->only(['fullname','phone','email','date_birth','address','gender','accnt_name','accnt_num','accnt_bank','country']);
        if ($request->hasFile('image')) {
            $image=$request->image->store('upload');
            $user->deleteImage();
            $data['image']='storage/'.$image;
        }

        if ($request->state && $request->state!="Select State") {
            $data['state']=$request->state;
        }
         if ($request->city && $request->city!="Select City") {
            $data['city']=$request->city;
        }
        $data['updated']=1;
        $data['approved']=1;
        $user->update($data);

        session()->flash('success',"Your profile is updated successfully");
        return redirect()->back();  
    }

     public function saveDrugUpload(Request $request)
    {
        $data=$request->only(['location','remark','type']);
        if ($request->hasFile('prescription')) {
            $image=$request->prescription->store('upload');
            
            $data['prescription']='storage/'.$image;
        }

         $data['user_id']=auth()->user()->id;
         //$data['type']="drug";
        Upload::create($data);

        session()->flash('success',"Successfully sent");
        return redirect()->back();  
    }

    public function bookDoctor(BookDoctorRequest $request,User $user){
       

        $dateBook=$request->input('dateBook');
        $timeBook=$request->input('timeBook');
        $patient_location=$request->input('patient_location');
        $consultTime=$user->consult_hour;
        $day= date("l",strtotime($dateBook));//get just day from book date

        $booking_date=date("Y-m-d H:i:s",strtotime($dateBook.' '.$timeBook));
        $booking_time=date('H:i:s',strtotime('+ '.$user->consult_hour,strtotime($timeBook)));
        $booking_date_end=date("Y-m-d H:i:s",strtotime("+ ".$user->consult_hour,strtotime($dateBook.' '.$timeBook)));

         //check if doctor is Approved
         //dd($user);
         if (!$user->isApproved()) {
             session()->flash('error',"Oops!! Doctor is not yet Approved");
            return redirect()->back();
         }
        //check if booking date is less than current date
        $FirstDay = date("Y-m-d H:i:s", strtotime('sunday last week'));
        $LastDay = date("Y-m-d H:i:s", strtotime('sunday this week'));  

        
        if ($booking_date<date('Y-m-d H:i:s')) {
            //booking date is less than current date
            session()->flash('error',"Booking Date chosen must not be less than current date");
            return redirect()->back();
        } 
        

        //check if booking date is between a day in current week
        if ($booking_date > $FirstDay && $booking_date > $LastDay) {
            # booking date is not this week
            session()->flash('error',"Booking Date must be within this week");
            return redirect()->back();
        } 
        //dd($FirstDay);

        //select doctor schedule by day chosen
        $schedule=$user->schedules()->where('day',$day)->first();
        //check if the day patient book is among doctor schedule

        if (!$schedule) {
            session()->flash('error',"Doctor not available on this day");
            return redirect()->back();
        } 
        //check if doctor the time patient wants to book is between doctors time for that day
        //10pm  6pm
        if(strtotime($booking_time)>strtotime($schedule->start_time)&&strtotime($booking_time)>strtotime($schedule->end_time)){
            session()->flash('error',"Doctor is unavailable at this time of the day");
            return redirect()->back();
            //dd("hmmn");
        }

        //check if doctor has been booked
        //status:1=pending,2=paid,3=ongoing,4=closed
        $book=$user->doctorAppointments()->where('start_book_time','>=',$booking_date)
        ->where('start_book_time',"<=",$booking_date_end)
        ->where('status','!=',4)->first();
        if ($book) {
            session()->flash('error',"Doctor has been booked on this date");
            return redirect()->back();
        }

        $newBooking=$user->doctorAppointments()->create([
            "patient_id"=>auth()->user()->id,
            "hour"=>$user->consult_hour,
            "start_book_time"=>$booking_date,
            "status"=>1,
            'consult_type_id'=>$user->consult_type_id,
            'patient_location'=>$patient_location,
            'amount'=>$request->input('amount')
        ]);
        session(['bookId' => $newBooking->id,'doctor_id'=>$user->id,'amount'=>$request->input('amount')]);
        session()->flash('success',"Booking pending,complete booking by making payment");
            return redirect()->route('patient.showPaymentBooking');
    }

    public function showBookingPayment(){
        // if (session()->exists('bookId'))
        // {
        //     return redirect()->back(); 
        // }
        return view('home.booking_payment');
    }



    public function storeBookingPayment(Request $request,Book $book){
        $txRef=$request->input('txref');
        $amount=session('amount');
        $bookId=session('bookId');
        $doctor_id=session('doctor_id');
        $book->update(['status'=>2]);

        BookTransaction::create([
            'trans_ref'=>$txRef,
            'amount'=>$amount,
            'patient_id'=>auth()->user()->id,
            'book_id'=>$bookId,
            'doctor_id'=>$doctor_id
        ]);

        //send notification to doctor 
        //dd($book->doctor);

        $book->doctor->notify(new NewBooking($book));
        session()->forget(['amount','bookId','doctor_id']);

        return response()->json(['status'=>'success']);

    }
    public function bookingSuccess(){
        return view('home.success')->with('user',auth()->user());
    }

    public function bookingList(){
        $bookings=auth()->user()->patientAppointments()->where("is_chat",null)->status()->orderDesc()->simplePaginate(4);
        return view('patients.allBooking')->with('bookings',$bookings);
    }


    public function showBooking(Book $book){
        
        return view('patients.showBooking')->with('book',$book)->with('chats',Chat::where('book_id',$book->id)->get());
    }

    public function sendChat(Book $book){
        //dd(request()->message);
        $text=request()->message;
        Chat::create([
            "message"=>$text,
            "user_id"=>auth()->user()->id,
            "book_id"=>$book->id,
            "user_type"=>"patient"
        ]);
        broadcast(new NewMessage($text,$book))->toOthers();
        return response()->json(['status'=>true,'message'=>$text,'user_type'=>'patient']);
    }

    public function automatedDrugs(){
        $books=Book::where("patient_id",auth()->user()->id)->orderByDesc('id')->simplePaginate(5);
        return view('patients.automatedDrugs')->with('books',$books);
    }  
    public function automatedTest(){
        $books=Book::where("patient_id",auth()->user()->id)->orderByDesc('id')->simplePaginate(5);
        return view('patients.automatedTest')->with('books',$books);
    }  
    public function transactionSuccess(){
       
        return view('home.transactionSuccess');
    }    
    //shows a listof pharmacy
    public function pharmacyList(Book $book){
        $pharmacies=User::approved()->where('type',3)
        ->where('city',auth()->user()->city)->orderByRaw("RAND()")->paginate(6);
       //  $drugs=AutomatedDrug::where('patient_id',auth()->user()->id)->where("status",0)->get();
        
       //  foreach ($drugs as $key => $d) {
       //      $a[]=$d->prescriptions;
       //      $b[]=$d->dosage_form;
       //  }
       //  //$pharm=DB::table('drugs')->whereIn('generic_name',$a)
       //  //->whereIn('dosage_form',$b)
       // // ->groupBy('user_id')
       //  //->get();
       //  dd($this->getDistinctPharmacy($a,$b));
        //dd($pharmacy);
        return view('patients.pharmacy')->with('pharmacies',$pharmacies)->with("book",$book);
    }
     //shows a listof all pharmacy
    public function pharmacyAllList(Book $book){
        $pharmacies=User::approved()->where('type',3)
        ->orderByRaw("RAND()")->paginate(6);
       //  $drugs=AutomatedDrug::where('patient_id',auth()->user()->id)->where("status",0)->get();
        
       //  foreach ($drugs as $key => $d) {
       //      $a[]=$d->prescriptions;
       //      $b[]=$d->dosage_form;
       //  }
       //  //$pharm=DB::table('drugs')->whereIn('generic_name',$a)
       //  //->whereIn('dosage_form',$b)
       // // ->groupBy('user_id')
       //  //->get();
       //  dd($this->getDistinctPharmacy($a,$b));
        //dd($pharmacy);
        return view('patients.pharmacy')->with('pharmacies',$pharmacies)->with("book",$book)->with('all',true);
    }
     public function labList(Book $book){
        $labs=User::approved()->where('type',4)
        ->where('city',auth()->user()->city)->orderByRaw("RAND()")->simplePaginate(6);
       //  $drugs=AutomatedDrug::where('patient_id',auth()->user()->id)->where("status",0)->get();
        
       //  foreach ($drugs as $key => $d) {
       //      $a[]=$d->prescriptions;
       //      $b[]=$d->dosage_form;
       //  }
       //  //$pharm=DB::table('drugs')->whereIn('generic_name',$a)
       //  //->whereIn('dosage_form',$b)
       // // ->groupBy('user_id')
       //  //->get();
       //  dd($this->getDistinctPharmacy($a,$b));
        //dd($pharmacy);
        return view('patients.labs')->with('labs',$labs)->with("book",$book);
    }

    public function drugTransaction(){
        $transactions=DrugTransaction::where('patient_id',auth()->user()->id)->get();
       
        return view('patients.drugTransaction')->with('transactions',$transactions);
    }
    public function testTransaction(){
        $transactions=TestTransaction::where('patient_id',auth()->user()->id)->get();
       
        return view('patients.testTransaction')->with('transactions',$transactions);
    }
    public function drugUpload(){
        $drugs=Upload::where('user_id',auth()->user()->id)->get();
       
        return view('patients.drugUpload')->with('drugs',$drugs);
    }


    public function saveDrugTransaction(Request $request,Book $book){

        //get drugs user wants to buy...
      if($request->payOnDelivery){
        //patient wants to pay on delivery
        $transaction=DrugTransaction::create([
            "trans_ref"=>rand(10000,99999),
            "amount"=>$request->amount,
            "book_id"=>$book->id,
            "patient_id"=>auth()->user()->id,
            "pharmacy_id"=>$request->pharmacy_id,
            "doctor_id"=>$book->doctor_id,
            "address"=>$request->address,
            "city"=>$request->city,
            "status"=>5,
            "delivery"=>1
        ]);
        $book->drugs()->update(["status"=>1]);
        return redirect()->route('patient.showTransactionSuccess');
       // $transaction->pharmacy->notify(new PayDrugOnDelivery($book,$transaction));
      }else{
        $transaction=DrugTransaction::create([
            "trans_ref"=>$request->txref,
            "amount"=>$request->amount,
            "book_id"=>$book->id,
            "patient_id"=>auth()->user()->id,
            "pharmacy_id"=>$request->pharmacy_id,
            "doctor_id"=>$book->doctor_id,
            "address"=>$request->address
        ]);
        $book->drugs()->update(["status"=>1]);
        $transaction->pharmacy->notify(new TransactionNotify($book));
      }
      return response()->json(['status'=>true]);
    }
    public function saveTestTransaction(Request $request,Book $book){
        //get test user wants to buy...


        $transaction=TestTransaction::create([
            "trans_ref"=>$request->txref,
            "amount"=>$request->amount,
            "book_id"=>$book->id,
            "patient_id"=>auth()->user()->id,
            "lab_id"=>$request->lab_id,
            "doctor_id"=>$book->doctor_id,
            "address"=>$request->address
        ]);
        $book->tests()->update(["status"=>1]);
        $transaction->lab->notify(new TestTransactionNotify($book));
        return response()->json(['status'=>true]);

    }
    public function markRecieved(Request $request){
        //get drugs user wants to buy...
        $transaction=DrugTransaction::where('id',$request->transaction)
        ->update(["status"=>2]);
        // $transaction->status=2;
        // $transaction->save();
        return response()->json(['status'=>true]);

    }
    public function markTestRecieved(Request $request){
        //get drugs user wants to buy...
        $transaction=TestTransaction::where('id',$request->transaction)
        ->update(["status"=>2]);
        // $transaction->status=2;
        // $transaction->save();
        return response()->json(['status'=>true]);

    }
     public function drugComplain(Request $request){
        //get drugs user wants to buy...
        $transaction=DrugTransaction::where('id',$request->transaction)
        ->update(["status"=>0,"complainType"=>$request->complainType,"remark"=>$request->remark,"complainDate"=>now()]);
        
         session()->flash('success',"Your complain has been routed to admin.");
            return redirect()->route('patient.drugTransaction');

    }
     public function testComplain(Request $request){
        //get drugs user wants to buy...
        $transaction=TestTransaction::where('id',$request->transaction)
        ->update(["status"=>0,"complainType"=>$request->complainType,"remark"=>$request->remark,"complainDate"=>now()]);
        
         session()->flash('success',"Your complain has been routed to admin.");
            return redirect()->route('patient.drugTransaction');

    }

    public function buyDrugs(User $user,Book $book){
          $drugs=AutomatedDrug::where('patient_id',auth()->user()->id)
          ->where("book_id",$book->id)
          ->where("status",0)->get();
        
        foreach ($drugs as $key => $d) {
            $a[]=$d->prescriptions;
            $b[]=$d->dosage_form;
        }


        //a.trade_name LIKE '%" . implode("%' OR a.trade_name LIKE '%", $drug) . "%

       //  $pharm=DB::table('drugs')->whereRaw("generic_name Like '%".implode("%' OR generic_nam LIKE '%", $a)."%'")
       //  ->whereRaw("dosage_form Like '%".implode("%' OR dosage_form LIKE '%", $b)."%'")
       // ->where('user_id',$user->id)
       //  ->get();

        $drugs=DB::select(DB::raw("select st.user_id,st.addon_price,st.dosage_form,st.strength,ad.prescriptions,ad.quantity,ad.dosage_form from drugs st inner join automated_drug_requests ad on (st.generic_name=ad.prescriptions) and ad.dosage_form=st.dosage_form WHERE st.user_id=".$user->id." and ad.status=0 and ad.patient_id=".auth()->user()->id));
        
        $totalAmount=DB::select(DB::raw("select sum(st.addon_price*ad.quantity) as total from drugs st inner join automated_drug_requests ad on (st.generic_name=ad.prescriptions) and ad.dosage_form=st.dosage_form WHERE st.user_id=".$user->id." and ad.status=0 and ad.patient_id=".auth()->user()->id." LIMIT 1"));
        
        return view('patients.buyDrugs')->with("drugs",$drugs)
        ->with('totalAmount',$totalAmount)->with("pharmacy",$user)->with("patient",auth()->user())
        ->with("sentDrugs",$a)
        ->with('book',$book);
        
    }
    public function payTest(User $user,Book $book){
          $tests=AutomatedTest::where('patient_id',auth()->user()->id)
          ->where("book_id",$book->id)
          ->where("status",0)->get();
        
        foreach ($tests as $key => $d) {
            $a[]=$d->test;
            //$b[]=$d->dosage_form;
        }


        //a.trade_name LIKE '%" . implode("%' OR a.trade_name LIKE '%", $drug) . "%

       //  $pharm=DB::table('drugs')->whereRaw("generic_name Like '%".implode("%' OR generic_nam LIKE '%", $a)."%'")
       //  ->whereRaw("dosage_form Like '%".implode("%' OR dosage_form LIKE '%", $b)."%'")
       // ->where('user_id',$user->id)
       //  ->get();

        $tests=DB::select(DB::raw("select st.user_id,st.addon_price,ad.test from tests st inner join automated_test_requests ad on (st.name=ad.test) WHERE st.user_id=".$user->id." and ad.status=0 and ad.patient_id=".auth()->user()->id));
        
        $totalAmount=DB::select(DB::raw("select sum(st.addon_price) as total from tests st inner join automated_test_requests ad on (st.name=ad.test) WHERE st.user_id=".$user->id." and ad.status=0 and ad.patient_id=".auth()->user()->id." LIMIT 1"));
        
        return view('patients.payTest')->with("tests",$tests)
        ->with('totalAmount',$totalAmount)->with("lab",$user)->with("patient",auth()->user())
        ->with("sentTests",$a)
        ->with('book',$book);
        
    }
    //freelancer chat request
    public function chatRequest(User $user){

    $request=Book::where("patient_id",auth()->user()->id)->where("doctor_id",$user->id)->first();

      if(!$request){
      $grant=Book::create([
          "patient_id"=>auth()->user()->id,
          "doctor_id"=>$user->id,
          "status"=>0,
          "is_chat"=>"yes"
        ]);
        return redirect()->route('patient.showBooking',$grant->id);
      }else{
        //dd('dd');
        return redirect()->route('patient.showBooking',$request->id);
      }
     
      //return view('patient.chatHistory')->with('requests')
    }
    //freelancer
    // public function showFreelanceChat(Book $request){
    //   return view('patients.showFreelancerChat'); 
    // }
    //
    public function chatHistory(){
  $chats=Book::where('patient_id',auth()->user()->id)->where('is_chat',"yes")->get();
  //dd($chats)
     return view('patients.chatList')->with('chats',$chats);
    }
    public function getDistinctPharmacy($drugs,$dosage_form){
       return DB::table('drugs')
        ->join('users',function($join) use($drugs){
            $join->on('drugs.usr_id',"=","users.id")
            ->where('drugs.generic_name','LIKE',"%". implode("%' OR drugs.generic_name LIKE '%", $drugs));

        })->get();
       // dd($value);
    }

}
