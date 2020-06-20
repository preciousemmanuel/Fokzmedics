<?php

use Illuminate\Database\Seeder;
use App\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bank::create([
        	'name'=>'Fidelity Bank'
        ]);
        Bank::create([
        	'name'=>'GTBank'
        ]);
    }
}
