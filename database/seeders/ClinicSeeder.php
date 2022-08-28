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
        Clinic::factory(1)->create([
            'organization_id' => 1,
            'name' => 'Bayside Day Procedure And Specialist Centre'
        ]);
        Clinic::factory(1)->create([
            'organization_id' => 1,
            'name' => 'Bayswater Day Procedure And Specialist Centre'
        ]);
        Clinic::factory(1)->create([
            'organization_id' => 1,
            'name' => 'Rosebud Day Hospital'
        ]);

        Clinic::factory(1)->create([
            'organization_id' => 1,
            'name' => 'Hampton Day Hospital'
        ]);

        Clinic::factory(2)->create(['organization_id' => 2]);
    }
}
