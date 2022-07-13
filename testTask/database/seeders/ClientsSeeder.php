<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
        DB::table('clients')->insert([
            'full_name'=>Str::random(5)." ".Str::random(5)." ".Str::random(5),
            'phone_num'=>'+7'.rand(100,999).rand(100,999).rand(1000,9999),
            'gender'=>rand(0,1),
            'Address'=>Str::random(20)
        ]);
        }
    }
}
