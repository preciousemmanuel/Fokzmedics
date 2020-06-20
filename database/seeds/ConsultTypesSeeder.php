<?php

use Illuminate\Database\Seeder;
use App\ConsultType;

class ConsultTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ConsultType::create([
        	'name'=>'Home Service',
        	'slug'=>str_slug('Home Service')
        ]);

         ConsultType::create([
        	'name'=>'Office Service',
        	'slug'=>str_slug('Office Service')
        ]);

          ConsultType::create([
        	'name'=>'Live chat',
        	'slug'=>str_slug('Live chat')
        ]);
    }
}
