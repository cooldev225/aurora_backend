<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clinic;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clinic::factory(2)->create(['organization_id' => 1]);
        Clinic::factory(2)->create(['organization_id' => 2]);
    }
}
