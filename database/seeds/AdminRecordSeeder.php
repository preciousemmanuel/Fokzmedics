<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class AdminRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	"fullname"=>"Admin",
        	"email"=>"admin@admin.com",
        	"password"=>Hash::make('admin'),
        	"admin_role"=>1,
        	"email_verified_at"=>now(),
        	 "type"=>6
        ]);
    }
}
