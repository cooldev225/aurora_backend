<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\Clinic;
use App\Models\SpecialistClinicRelation;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->faker = Faker::create();

        User::factory()->create([
            'username'          => 'admin',
            'email'             => 'admin@mail.com',
            'role_id'           => UserRole::ADMIN,
            'organization_id'   => 1,
        ]);

        User::factory()->create([
            'username'          => 'org-admin',
            'email'             => 'organizationAdmin@mail.com',
            'role_id'           => UserRole::ORGANIZATION_ADMIN,
            'organization_id'   => 1,
        ]);

        User::factory()->create([
            'username'          => 'org-manager',
            'email'             => 'organizationManager@mail.com',
            'role_id'           => UserRole::ORGANIZATION_MANAGER,
            'organization_id'   => 1,
        ]);

        User::factory()->create([
            'username'          => 'specialist',
            'email'             => 'specialist@mail.com',
            'role_id'           => UserRole::SPECIALIST,
            'organization_id'   => 1,
        ]);



        User::factory(40)->create();



        foreach (User::all() as $user) {
            if ($user->role_id == UserRole::SPECIALIST) {

                $ana1 = User::factory(1)->create(['role_id' => UserRole::ANESTHETIST, 'organization_id' => $user->organization->id])->first();
                $ana2 = User::factory(1)->create(['role_id' => UserRole::ANESTHETIST, 'organization_id' => $user->organization->id])->first();
            }
        }

        $specialists = User::where('role_id',5)->get();

        foreach($specialists as $user){
            foreach(Clinic::where('organization_id', $user->organization_id)->get() as $clinic){
                SpecialistClinicRelation::create([ 
                    'specialist_id' => $user->id,
                    'clinic_id' => $clinic->id, 
                    'provider_number' => strtoupper($this->faker->bothify('??????#')),
                ]);
            }
        }

    }
}
