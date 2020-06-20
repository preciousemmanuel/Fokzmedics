<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Book;

class StartAppointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'startBook:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is to update status of booking when date is reached';

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
        //
        Book::where('start_book_time','<=',NOW())
        ->where('status',2)
        ->update(["status"=>3]);
        $this->info("booking is due");
    }
}
