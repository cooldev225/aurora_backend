<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_arganizations = Organization::factory(3)->create();

        # assign user_organization of organziation
        foreach ($all_arganizations as $org) {
            $user = $org->owner();

            $user->organization_id = $org->id;
            $user->save();
        }
    }
}
