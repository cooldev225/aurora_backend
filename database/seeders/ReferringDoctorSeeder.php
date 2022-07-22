<?php

namespace Database\Seeders;

use App\Models\ReferringDoctor;
use Illuminate\Database\Seeder;

class ReferringDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferringDoctor::factory(30)->create();
    }
}
