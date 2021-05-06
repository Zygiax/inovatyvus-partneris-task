<?php

namespace Database\Seeders;

use App\Models\TruckMake;
use Illuminate\Database\Seeder;

class TrucksMakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TruckMake::truncate();

        $makes = [['name' => 'Volvo'], ['name' => 'VAZ'], ['name' => 'Mercedes'], ['name' => 'GAZ']];

        foreach ($makes as $make)
        {
            TruckMake::create($make);
        }
    }
}
