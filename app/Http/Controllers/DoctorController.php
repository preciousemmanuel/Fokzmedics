<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\ConsultType;
use App\Specialization;
use App\Bank;
use App\Schedule;
use App\Chat;
use App\Drug;
use App\AutomatedDrug;
use App\AutomatedTest;
use App\CentralDrug;
use App\Purse;
use App\Review;
use App\Events\NewMessage;
use App\Http\Requests\Doctors\UpdateProfileRequest;
use App\Http\Requests\Doctors\CreateScheduleRequest;
use App\Http\Requests\Doctors\SendDrugRequest;
use App\Http\Requests\Doctors\SendTestRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Freelancer\AddPatientRequest;
use App\Notifications\CreatePatientNotify;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */

    public function __construct()
    {
        $this->middleware(['verifyType:2','isSetType']);
        $this->middleware('isUpdated:2')->except(['profile','updateProfile','uploadLicence','deleteLicence']);
        $this->middleware(['isApproved:2'])->except(['index','profile','updateProfile','uploadLicence','deleteLicence']);
    }
    public function index()
    {
        //
        $pendingBookings=Book::where('doctor_id',auth()->user()->id)
        ->where('status',0)->get();
        $completedBookings=Book::where('doctor_id',auth()->user()->id)
        ->where('status',1)->get();
        $totalBookings=Book::where('doctor_id',auth()->user()->id)->get();
        $paid=Purse::where("user_id",auth()->user()->id)->where("paid",1)->get()->sum('amount');
        $pending=Purse::where("user_id",auth()->user()->id)->where("paid",0)->get()->sum('amount');

        return view('doctors.index')->with('pendingBookings',$pendingBookings)
        ->with("completedBookings",$completedBookings)
        ->with("pending",$pending)
        ->with("paid",$paid)
        ->with("totalBookings",$totalBookings);
    }

    
    public function reviews(){
        //$banks=DB::table('banks')->get();
        return view('doctors.reviews')
        ->with('reviews',Review::where('reviewed_id',auth()->user()->id)->simplePaginate(7));
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
    public function register()
    {
        return view('doctors.register');
    }
     public function addPatient(AddPatientRequest $request)
    {
        $user=User::create([
            "fullname"=>$request->fullname,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "referal"=>auth()->user()->email,
            "password"=>Hash::make('1234'),
            "email_verified_at"=>now(),
            "type"=>1
        ]);
        $user->notify(new CreatePatientNotify($user));
        session()->flash('success',"Patient created successfully");
        
        return redirect()->back();
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
       // dd($request);
        $data=$request->only(['fullname','phone','email','languages','address','description','specialization_id','education','accnt_name','accnt_num','accnt_bank','consult_type_id','consulting_fee','hospital_address']);
        if ($request->hasFile('image')) {
            $image=$request->image->store('upload');
            $user->deleteImage();
            $data['image']='storage/'.$image;
        }
        if (!empty($request->country) && $request->country!="Select Country") {
            $data['country']=$request->country;
        }
        if ($request->state&& $request->state!="Select State") {
            $data['state']=$request->state;
        }
         if ($request->city && $request->city!="Select City") {
            $data['city']=$request->city;
        }
        $data['updated']=1;
      
        $data['consult_hour']=$request['consulting_hour'];
        $user->update($data);

        session()->flash('success',"Your profile is updated successfully");
        if (empty($user->licence)) {
            return redirect()->route('doctor.licence');
        }
        return redirect()->route('doctor.profile');
        
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
        //$banks=DB::table('banks')->get();
        $states=DB::table('states')->distinct()->get(['names']);
        return view('doctors.profile')
        ->with('banks',Bank::all())
        ->with('specializations',Specialization::all())
        ->with('consultypes',ConsultType::all())
        ->with('states',$states)
        ->with('user',auth()->user());
    }

    //show licence page
    public function licence(){
        return view('doctors.licence')
        ->with('user',auth()->user());
    }

    public function uploadLicence(Request $request,User $user){
        $image=$request->file('file');
        $imageName=$image->getClientOriginalName();
        $imagePath=$image->move(public_path('licence'),$imageName);
        $user->deleteLicenceFile();
        $user->update(['licence'=>'licence/'.$imageName]);
        return response()->json(['success'=>$imagePath]);
    }
    public function deleteLicence(Request $request,User $user){
       // $filename =  $request->get('filename');
        $user->deleteLicenceFile();
        $user->update(['licence'=>""]);
        
        return "success";
    }
    public function showSchedule(){
        return view('doctors.schedule')->
        with("schedules",Schedule::where('doctor_id',auth()->user()->id)->get())
        ->with('user',auth()->user());
    }
    public function editSchedule(Schedule $schedule){
         session()->flash('error',"Edit this schedule");
        return view('doctors.schedule')->
        with("schedule",$schedule)
        ->with("schedules",Schedule::where('doctor_id',auth()->user()->id)->get())
        ->with('user',auth()->user());
    }

    public function sendExtra(Request $request,Book $book){
        $book->update([
            "complaints"=>$request->complaints,
            "examination"=>$request->examination,
            "diagnosis"=>$request->diagnosis
        ]);
        session()->flash('success',"Success!");
        return redirect()->back();
    }
    public function centralDrug(){
        $drugs=CentralDrug::simplePaginate(7);
        return view('admin.centralDrug')->with("drugs",$drugs);
    }
    public function updateSchedule(CreateScheduleRequest $request,Schedule $schedule){
        $schedule->update([
            "day"=>$request->day,
            "start_time"=>$request->startTime,
            "end_time"=>$request->endTime
        ]);
        session()->flash('success',"Schedule updated successfully");
        return redirect()->route('doctor.schedule');
    }

    public function markBookComplete(Request $request){
        $book_id=$request->book;
        Book::where("id",$book_id)->update(["status"=>5]);
         return response()->json(["status"=>true,'message' => 'Success']);
    }
    public function startBook(Request $request){
        $book_id=$request->book;
        Book::where("id",$book_id)->update(["status"=>3]);
         return response()->json(["status"=>true,'message' => 'Success']);
    }
    public function createSchedule(CreateScheduleRequest $request){
        Schedule::create([
            "day"=>$request->day,
            "start_time"=>$request->startTime,
            "end_time"=>$request->endTime,
            "doctor_id"=>auth()->user()->id
        ]);
        session()->flash('success',"Schedule added successfully");
        return redirect()->route('doctor.schedule');
    }
    public function bookingList(){
        $bookings=auth()->user()->doctorAppointments()->orderDesc()->status()->simplePaginate(5);
        return view('doctors.allBooking')->with('bookings',$bookings);
    }
    public function showBooking(Book $book){
        return view('doctors.showBook')->with('book',$book)->with('chats',Chat::where('book_id',$book->id)->get());
    }

    public function listDrugs(Book $book){
        $drugs=CentralDrug::all();
        return view('doctors.listDrugs')
        ->with('book',$book)
        ->with('drugs',$drugs);
    }

    //chat with doctor and patient
    public function sendChat(Book $book){
        //dd(request()->message);
        $text=request()->message;
        Chat::create([
            "message"=>$text,
            "user_id"=>auth()->user()->id,
            "book_id"=>$book->id,
            "user_type"=>"doctor"
        ]);
        broadcast(new NewMessage($text,$book))->toOthers();
        return response()->json(['status'=>true,'message'=>$text,'user_type'=>'doctor']);
    }
    public function sendDrug(SendDrugRequest $request,Book $book){

           
            AutomatedDrug::create([
            "prescriptions"=>$request->drug,
            "strength"=>$request->strength,
            "dosage_form"=>$request->dosage_form,
            "duration"=>$request->duration,
            "quantity"=>$request->quantity,
            "frequency"=>$request->frequency,
            "dose"=>$request->dose,
            "status"=>0,
            "book_id"=>$book->id,
            "patient_id"=>$book->patient->id,
            "doctor_id"=>$book->doctor->id,
            "doctor_comment"=>$request->doctor_comment
        ]);
            
       
         session()->flash('success',"Drug is successfully sent..");
         return redirect()->back();
       // // broadcast(new NewDrugEvent($drug))->toOthers();
       //return redirect()->route('doctor.showBooking',$book->id);
    }
    // public function sendDrug(SendDrugRequest $request,Book $book){

        
    //     $picks=count($request->input('drugs'));
    //     //dd($request->dose[0]);
    //     for ($i=0; $i <$picks ; $i++) { 
    //         $dose=$request->dose[$i];
    //         if (!empty($request->frequency[$i]) || isset($request->frequency[$i])) {
    //                 AutomatedDrug::create([
    //         "prescriptions"=>$request->drugs[$i],
            
    //         "dosage_form"=>$request->dosage_form[$i],
    //         "duration"=>$request->duration[$i],
    //         //"quantity"=>$request->quantity,
    //         "frequency"=>$request->frequency[$i],
    //         "status"=>0,
    //         "book_id"=>$book->id,
    //         "patient_id"=>$book->patient->id,
    //         "doctor_id"=>$book->doctor->id,
    //     ]);
    //         }
       
    //    }
    //      session()->flash('success',"Drug is successfully sent");
    //    // // broadcast(new NewDrugEvent($drug))->toOthers();
    //    return redirect()->route('doctor.showBooking',$book->id);
    // }
    public function sendTest(SendTestRequest $request,Book $book){
        $test=AutomatedTest::create([
            "test"=>$request->test,
            "book_id"=>$book->id,
            "status"=>0,
            "patient_id"=>$book->patient->id,
            "doctor_id"=>$book->doctor->id
        ]);
        session()->flash('success',"Test is successfully sent");
       // broadcast(new NewDrugEvent($drug))->toOthers();
        return redirect()->back();
    }

}
