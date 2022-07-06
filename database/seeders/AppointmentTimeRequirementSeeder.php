<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppointmentTimeRequirement;
use App\Models\Organization;

class AppointmentTimeRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = Organization::all();

        foreach ($organizations as $organization) {
            AppointmentTimeRequirement::create([
                'organization_id' => $organization->id,
                'title' => 'diabetes',
                'base_time' => '12:00:00',
            ]);

            AppointmentTimeRequirement::create([
                'organization_id' => $organization->id,
                'title' => 'after noon',
                'type' => 'after',
                'base_time' => '12:00:00',
            ]);
        }
    }
}
