<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];
    // protected $fillable = [
    //     'fullname', 'email', 'password','type','phone','con'
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new VerifyEmail());
    // }

    //check type of user
    public function isUserType($type){
        return $this->type===$type;
    }

   

    public function deleteImage(){
      Storage::delete($this->image);
    }

    public function deleteLicenceFile(){
         //$path=public_path().'/licence/'.$filename;
        if (file_exists($this->licence)) {
            unlink($this->licence);
        }
        return;
    }

    public function scopeApproved($query){
        return $query->updated()->where('approved',1);
    }
    public function scopeUpdated($query){
        return $query->where('updated',1);
    }

    public function isUpdated(){
        return $this->updated;
    }
    public function isApproved(){
        return $this->approved;
    }

    public function scopeSearchSpecialization($query){
        $search=request()->query('specialization');
       // $search=request()->query('specialization');
        if (!$search) {
            return $query->orderDesc();
        }
        return $query->orderDesc()->where('specialization_id',$search);
    }

    public function scopeSearchName($query){
         $search=request()->query('search');
        if (!$search) {
            return $query->orderDesc();
        }
        return $query->orderDesc()->where('fullname','LIKE',"%{$search}%");
    }
    public function scopeSearchDoctorCity($query){
         $search=request()->query('city');
        if (!$search) {
            return $query->orderDesc();
        }
        return $query->orderDesc()->where('city','LIKE',"%{$search}%");
    }

    public function scopeOrderDesc($query){
        return $query->orderBy('id','DESC');
    }

    public function purses(){
        return $this->hasMany(Purse::class);
    }

    //patient

    public function drugPrescriptions(){
       return $this->hasMany(AutomatedDrug::class,'patient_id');
    }
    public function testPrescriptions(){
       return $this->hasMany(AutomatedTest::class,'patient_id');
    }
    public function patientAppointments(){
       return $this->hasMany(Book::class,'patient_id');
    }


    //doctors
    public function doctorAppointments(){
       return $this->hasMany(Book::class,'doctor_id');
    }


    public function consulting_type(){
        return $this->belongsTo(ConsultType::class,'consult_type_id');
    }
    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }
    public function schedules(){
        return $this->hasMany(Schedule::class,'doctor_id');
    }

    public function payableAmount($amount){
        $percent=(16/100)*$amount;
        return $percent+$amount;
    }

    //pharmacist
    public function drugTransactions(){
        return $this->hasMany(DrugTransaction::class,'pharmacy_id');
    }

    public function drugs(){
        return $this->hasMany(Drug::class);
    }

    //diagnostic
     public function tests(){
        return $this->hasMany(Test::class);
    }

    //freelancer
    public function freelancercategory(){
        return $this->belongsTo(Freelancercategory::class,'category_id');
    }


}
