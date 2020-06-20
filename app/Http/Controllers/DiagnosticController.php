<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AutomatedTest;
use App\Bank;
use App\Test;
use App\Http\Requests\Diagnostic\UpdateProfileRequest;
use App\Http\Requests\Diagnostic\AddTestRequest;
use App\Centraltest;
use App\Purse;
use App\DrugTransaction;
use Illuminate\Support\Facades\DB;
class DiagnosticController extends Controller
{

    public function __construct()
    {
        $this->middleware(['verifyType:4','isSetType']);
        //$this->middleware(['isUpdated:4'])->only(['index']);
        $this->middleware('isUpdated:4')->except(['profile','updateProfile','uploadLicence','deleteLicence','licence']);
        $this->middleware(['isApproved:4'])->except(['index','profile','updateProfile','uploadLicence','deleteLicence','licence']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('diagnostic.index');
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
    public function centralTest(){
        $tests=Centraltest::simplePaginate(7);
        return view('diagnostic.centralTest')->with("tests",$tests);
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

    public function profile(){
        //$banks=DB::table('banks')->get();
        $states=DB::table('states')->distinct()->get(['names']);
        return view('diagnostic.profile')
        ->with('banks',Bank::all())
        ->with('states',$states)
        ->with('user',auth()->user());
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {  
        $data=$request->only(['fullname','phone','business_name','address','licence_number','supretendent_name','education','accnt_name','accnt_num','accnt_bank','consult_type','consulting_fee','hospital_address']);
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
      
        $user->update($data);

        session()->flash('success',"Your profile is updated successfully");
        if (empty($user->licence)) {
            return redirect()->route('diagnostic.licence');
        }
        return redirect()->route('diagnostic.profile');
        
    }

    public function moveTests(Request $request){
        $tests=Centraltest::all();
        foreach ($tests as $key => $test) {
           Test::insert([
            "name"=>$test->name,
            "price"=>$test->price,
            "user_id"=>auth()->user()->id,
            "addon_price"=>auth()->user()->payableAmount($test->price)
            ]);
        }
        return response()->json(['status'=>true]);
    }

    public function markDelivered(Request $request){
        $transaction_id=$request->transaction;
        DrugTransaction::where("id",$transaction_id)->update(["status"=>5]);
         return response()->json(["status"=>true,'message' => 'Success']);
    }
    public function drugTransaction(){
        $paid=Purse::where("user_id",auth()->user()->id)->where("paid",1)->get()->sum('amount');
        $pending=Purse::where("user_id",auth()->user()->id)->where("paid",0)->get()->sum('amount');
       // $purse=Purse::where("user_id",auth()->user()->id)->get();
        $transactions=DrugTransaction::where("pharmacy_id",auth()->user()->id)->simplePaginate(10);
       
        return view('pharmacy.drugTransaction')->with('transactions',$transactions)->with("paid",$paid)
        ->with("pending",$pending);
    } 
    public function moveTest(Request $request){
        $test=Centraltest::find($request->test);
        
           Test::insert([
            "name"=>$test->name,
            
            "price"=>$test->price,
            "user_id"=>auth()->user()->id,
            "addon_price"=>auth()->user()->payableAmount($test->price)
            ]);
        
        return response()->json(['status'=>true]);
    }

     //show licence page
     public function licence(){
        return view('diagnostic.licence')
        ->with('user',auth()->user());
    }

     //show drugs page
     public function showTest(){
         
        return view('diagnostic.showTest')
        ->with('tests',auth()->user()->tests)
        ->with('user',auth()->user());
    }

     public function importExcel(){
         
        return view('diagnostic.importDrug')
        ->with('user',auth()->user());
    }

    public function storeTest(AddTestRequest $request, User $user){

       // $num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
       $user->tests()->create([
           "name"=>$request->name,
           
           "price"=>$request->price,
           "addon_price"=>$user->payableAmount($request->price),
           ]);
        session()->flash("success","Test stored successfully");
        return redirect()->back();
    }
    public function updateTest(AddTestRequest $request, Test $test){

        //$num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
        //$tablet_type=empty($request->tablet_type)?$drug->tablet_type:$request->tablet_type;
       $test->update([
           "name"=>$request->name,
           
           "price"=>$request->price,
           "addon_price"=>auth()->user()->payableAmount($request->price)
          
           ]);
        session()->flash("success","Test updated successfully");
        return redirect()->back();
    }

    public function uploadLicence(Request $request,User $user){
        $image=$request->file('file');
        $imageName=$image->getClientOriginalName();
        $imagePath=$image->move(public_path('licence'),$imageName);
        $user->deleteLicenceFile();
        $user->update(['licence'=>'licence/'.$imageName]);
        return response()->json(['success'=>$imagePath]);
    }
    public function excelDrugUpload(Request $request,User $user){
        $image=$request->file('file');
                if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = [
                        'generic_name' => $key[0],
                         'trade_name' => $key[1],
                         'strength' => $key[2],
                         'dosage_form' => $key[3],
                         'quantity' => $key[4],
                         'tablet_type' => $key[5],
                         'num_tablet' => $key[6],
                         'price' => $key[7],
                         'addon_price' => $user->payableAmount($key[7]),
                         'user_id' => $user->id,
                     ];
                }
                if(!empty($arr)){
                    \DB::table('drugs')->insert($arr);
                    //dd('Insert Record successfully.');
                    return response()->json(['success'=>"sucess"]);
                }
                
                 return response()->json(['failed'=>$image]);
                
            }
        }
        
    }
    public function deleteLicence(Request $request,User $user){
       // $filename =  $request->get('filename');
        $user->deleteLicenceFile();
        $user->update(['licence'=>""]);
        
        return "success";
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
