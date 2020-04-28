<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use\App\Bank;
use\App\Drug;
use\App\CentralDrug;
use\App\Centraltest;
use\App\Purse;
use\App\Setting;
use\App\Book;
use\App\Review;
use\App\Chat;
use\App\Freelancercategory;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Freelancer\UpdateProfileRequest;
use App\Http\Requests\Freelancer\AddPatientRequest;
use App\Notifications\CreatePatientNotify;
use App\Events\NewMessage;
use App\Http\Requests\Doctors\SendDrugRequest;
use App\AutomatedDrug;
use App\AutomatedTest;
use Illuminate\Support\Facades\DB;
class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware(['verifyType:5','isSetType','updateLastActive']);
        //$this->middleware(['isUpdated:5'])->only(['index']);
        $this->middleware('isUpdated:5')->except(['profile','updateProfile','uploadLicence','deleteLicence','licence']);
        $this->middleware(['isApproved:5'])->except(['index','profile','updateProfile','uploadLicence','deleteLicence','licence']);
    }

     public function index()
    {
        return view('freelancers.index')->with('setting',Setting::find(1));
    }
    public function register()
    {
        return view('freelancers.register');
    }


    public function centralDrug(){
        $drugs=CentralDrug::simplePaginate(20);
        return view('freelancers.centralDrug')->with("drugs",$drugs);
    }
    public function centralTest(){
        $tests=Centraltest::simplePaginate(20);
        return view('freelancers.centralTest')->with("tests",$tests);
    }
    public function purse(){
                $paid=Purse::where("user_id",auth()->user()->id)->where("paid",1)->get()->sum('amount');
        $pending=Purse::where("user_id",auth()->user()->id)->where("paid",0)->get()->sum('amount');

        return view('freelancers.purse')->with("pending",$pending)->with('paid',$paid);
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
        
        return redirect()->route('freelancer.register');
    }
    public function sendChat(Book $book){
        //dd(request()->message);
        $text=request()->message;
        Chat::create([
            "message"=>$text,
            "user_id"=>auth()->user()->id,
            "book_id"=>$book->id,
            "user_type"=>"freelancer"
        ]);
        broadcast(new NewMessage($text,$book))->toOthers();
        return response()->json(['status'=>true,'message'=>$text,'user_type'=>'freelancer']);
    }

     public function updateProfile(UpdateProfileRequest $request, User $user)
    {  
        $data=$request->only(['fullname','phone','address','licence_number','accnt_name','accnt_num','accnt_bank','description','education','country']);
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
        if (isset($request->category_id)) {
            $data['category_id']=$request->category_id;
        }
        $data['updated']=1;
      
        $user->update($data);

        session()->flash('success',"Your profile is updated successfully");
        
        return redirect()->route('freelancer.profile');
        
    }

    public function profile(){
        //$banks=DB::table('banks')->get();
        $states=DB::table('states')->distinct()->get(['names']);
        return view('freelancers.profile')
        ->with('banks',Bank::all())
        ->with('user',auth()->user())
        ->with('states',$states)
        ->with('categories',Freelancercategory::all());
    }
    public function reviews(){
        //$banks=DB::table('banks')->get();
        return view('freelancers.reviews')
        ->with('reviews',Review::where('reviewed_id',auth()->user()->id)->simplePaginate(7));
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
     public function chatHistory(){
        $chats=auth()->user()->doctorAppointments()->orderDesc()->status()->simplePaginate(5);
        return view('freelancers.chatList')->with('chats',$chats);
    }
    public function showChat(Book $book){
        return view('freelancers.showChat')->with('book',$book)->with('chats',Chat::where('book_id',$book->id)->get());
    }
     public function listDrugs(Book $book){
        $drugs=CentralDrug::all();
        return view('freelancers.listDrugs')
        ->with('book',$book)
        ->with('drugs',$drugs);
    }
     public function sendDrug(SendDrugRequest $request,Book $book){

        
        $picks=count($request->input('drugs'));
        //dd($request->dose[0]);
        for ($i=0; $i <$picks ; $i++) { 
            $dose=$request->dose[$i];
            if (!empty($request->frequency[$i]) || isset($request->frequency[$i])) {
                    AutomatedDrug::create([
            "prescriptions"=>$request->drugs[$i],
            
            "dosage_form"=>$request->dosage_form[$i],
            "duration"=>$request->duration[$i],
            //"quantity"=>$request->quantity,
            "frequency"=>$request->frequency[$i],
            "status"=>0,
            "book_id"=>$book->id,
            "patient_id"=>$book->patient->id,
            "doctor_id"=>$book->doctor->id,
        ]);
            }
       
       }
         session()->flash('success',"Drug is successfully sent");
       // // broadcast(new NewDrugEvent($drug))->toOthers();
       return redirect()->route('freelancer.showChat',$book->id);
    }
    // public function chatHistory(){
    //     //message is freelancer chat model
    //    $message = Message::select('sender_id')->distinct()->get();
    //    dd($message);
    // }

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
