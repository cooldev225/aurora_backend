<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\PreAdmissionConsent;
use App\Models\PreAdmissionQuestion;
use App\Models\PreAdmissionSection;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreAdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PreAdmissionSection::factory(5)->create();
        PreAdmissionQuestion::factory(30)->create();
        PreAdmissionConsent::truncate();

        $arrOrganization = Organization::all();
        $faker = Factory::create();
        foreach ($arrOrganization as $organization) {
            PreAdmissionConsent::create([
                'organization_id'   =>  $organization->id,
                'text'              =>  $faker->sentence()
            ]);
        }
    }
}
