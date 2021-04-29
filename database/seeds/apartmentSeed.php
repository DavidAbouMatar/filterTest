<?php

use Illuminate\Database\Seeder;
use App\Apartment;

class apartmentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            Apartment::create([
                'name' => str_random(8),
                'abreviation' => str_random(2),
           
            ]);
        }
    }
}
