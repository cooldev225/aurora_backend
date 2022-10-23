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
            'name' => 'Bayside Day Procedure And Specialist Centre',
            'nickname_code' => 'BS'
        ]);
        Clinic::factory(1)->create([
            'organization_id' => 1,
            'name' => 'Bayswater Day Procedure And Specialist Centre',
            'nickname_code' => 'BW'
        ]);
        Clinic::factory(1)->create([
            'organization_id' => 1,
            'name' => 'Rosebud Day Hospital',
            'nickname_code' => 'RBDH'
        ]);

        Clinic::factory(1)->create([
            'organization_id' => 1,
            'name' => 'Hampton Day Hospital',
            'nickname_code' => 'HDH'
        ]);

        Clinic::factory(2)->create(['organization_id' => 2]);
    }
}
