<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = DB::select("SELECT client_id from clients");
        foreach($clients as $cl)
        {
            $cars = rand(1,4);
            for( $i=0; $i<$cars ; $i++ )
            {
                DB::table('cars')->insert([
                    'color'=>Str::random(10),
                    'model'=>Str::random(10),
                    'brand'=>Str::random(10),
                    'plate_num'=>Str::random(6),
                    'on_parking'=>rand(0,1),
                    'client_id'=>$cl->client_id,
                ]);
            }
        }
    }
}
