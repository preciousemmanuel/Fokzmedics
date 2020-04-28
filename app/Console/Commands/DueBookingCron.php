<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Book;
use App\Event\DueBookingEvent;
class DueBookingCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dueBooking:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail notification to patient';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //check if booking date is 20minutes beforetime then send mails notification to 
        //patients and doctors
        //2pm
    // DB::table('test_table')->delete();
        
        $currentDate=Carbon::now();
        //$date->modify('-10 minutes');
        $formattedDate=$currentDate->subMinutes(10);
        $dueBooking= DB::table('books as b')
        ->join('users as p', 'b.patient_id', '=', 'p.id')
        ->join('users as d', 'b.doctor_id', '=', 'd.id')
        ->where('b.start_book_time','>=',DB::raw('DATE_SUB(NOW(), INTERVAL 10 MINUTE)'))
        ->select('b.start_book_time as start','p.fullname as pa_full','p.email as p_email','d.fullname as d_full','d.email as d_email')
        ->get();
       // $dueBooking= Book::where('start_book_time','<=',$formattedDate)->get();
        if($dueBooking->count()>0){
            foreach ($dueBooking as $key => $book) {
                Mail::send("emails.notifyDate",['book' => $book], function  ($mail) use ($book) {
                $mail->from('info@fokzmedics.com');
                $mail->to($book->d_email)
                ->cc($book->p_email)
                ->subject('Reminder');
            });
            }
            $this->info("booking is due");
            //booking is due
            //event(new DueBookingEvent($dueBooking));
        }else{
            //no booking is due
            $this->info("no booking is due");
        }
    
    }
}
