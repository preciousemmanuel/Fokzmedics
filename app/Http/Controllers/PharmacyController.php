<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AutomatedDrug;
use App\Bank;
use App\Drug;
use App\Http\Requests\Pharmacy\UpdateProfileRequest;
use App\Http\Requests\Pharmacy\AddDrugRequest;
class PharmacyController extends Controller
{

    public function __construct()
    {
        $this->middleware(['verifyType:3','isSetType']);
        $this->middleware(['isUpdated:3'])->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('pharmacy.index');
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

    public function profile(){
        //$banks=DB::table('banks')->get();
        return view('pharmacy.profile')
        ->with('banks',Bank::all())
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
         if (!empty($request->state)|| $request->state!="Select State") {
            $data['state']=$request->state;
        }
         if (!empty($request->city)|| $request->city!="Select City") {
            $data['city']=$request->city;
        }
        $data['updated']=1;
      
        $user->update($data);

        session()->flash('success',"Your profile is updated successfully");
        if (empty($user->licence)) {
            return redirect()->route('pharmacy.licence');
        }
        return redirect()->route('pharmacy.profile');
        
    }

     //show licence page
     public function licence(){
        return view('pharmacy.licence')
        ->with('user',auth()->user());
    }

     //show drugs page
     public function showDrugs(){
         
        return view('pharmacy.showDrug')
        ->with('drugs',auth()->user()->drugs)
        ->with('user',auth()->user());
    }

     public function importExcel(){
         
        return view('pharmacy.importDrug')
        ->with('user',auth()->user());
    }

    public function storeDrug(AddDrugRequest $request, User $user){

        $num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
       Drug::create([
           "generic_name"=>$request->generic_name,
           "trade_name"=>$request->trade_name,
           "quantity"=>$request->quantity,
           "price"=>$request->price,
           "addon_price"=>$user->payableAmount($request->price),
           "tablet_type"=>$request->tablet_type,
           "num_tablet"=>$num_tablet,
           "user_id"=>$user->id,
           "strength"=>$request->strength,
           "dosage_form"=>$request->dosage_form
           ]);
        session()->flash("success","Drug stored successfully");
        return redirect()->route("pharmacy.drugs");
    }
    public function updateDrug(AddDrugRequest $request, Drug $drug){

        $num_tablet=isset($request->num_tablet)?$request->num_tablet:0;
        $tablet_type=empty($request->tablet_type)?$drug->tablet_type:$request->tablet_type;
       $drug->update([
           "generic_name"=>$request->generic_name,
           "trade_name"=>$request->trade_name,
           "quantity"=>$request->quantity,
           "price"=>$request->price,
           "addon_price"=>auth()->user()->payableAmount($request->price),
           "tablet_type"=>$tablet_type,
           "num_tablet"=>$num_tablet,
           "strength"=>$request->strength,
           "dosage_form"=>$request->dosage_form
           ]);
        session()->flash("success","Drug updated successfully");
        return redirect()->route("pharmacy.drugs");
    }

    public function uploadLicence(Request $request,User $user){
        $image=$request->file('file');
        $imageName=$image->getClientOriginalName();
        $imagePath=$image->move(public_path('licence'),$imageName);
        $user->deleteLicenceFile();
        $user->update(['licence'=>$imagePath]);
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
