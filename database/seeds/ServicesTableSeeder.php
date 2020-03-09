<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('bank_service')->insert([
           ['name' => 'BCP', 'status' => 1],
           ['name' => 'Scotiabank', 'status' => 1],
           ['name' => 'BBVA', 'status' => 1],
       ]);
    }
}
