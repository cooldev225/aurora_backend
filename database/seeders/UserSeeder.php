<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\HRMUserBaseSchedule;
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

                HRMUserBaseSchedule::create([
                    'user_id'   => $user->id,
                    'clinic_id' => $user->organization->clinics->first()->id,
                    'start_time' => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
                    'end_time' => $this->faker->randomElement(['16:00:00', '14:30:00', '12:30:00']),
                    'week_day' => $this->faker->randomElement(["MON", "TUE"]),
                    'appointment_type_restriction'=> $this->faker->randomElement(["NONE", "PROCEDURE", "CONSULTATION"]),
                    'anesthetist_id'=>  $ana1->id
                ]);

                HRMUserBaseSchedule::create([
                    'user_id'   => $user->id,
                    'clinic_id' => $user->organization->clinics->first()->id,
                    'start_time' => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
                    'end_time' => $this->faker->randomElement(['16:00:00', '14:30:00', '12:30:00']),
                    'week_day' => $this->faker->randomElement(["WED", "THU"]),
                    'appointment_type_restriction'=> $this->faker->randomElement(["NONE", "PROCEDURE", "CONSULTATION"]),
                    'anesthetist_id'=> $ana1->id,
                ]);

                HRMUserBaseSchedule::create([
                    'user_id'   => $user->id,
                    'clinic_id' => $user->organization->clinics->first()->id,
                    'start_time' => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
                    'end_time' => $this->faker->randomElement(['16:00:00', '14:30:00', '12:30:00']),
                    'week_day' => $this->faker->randomElement(["FRI", "SAT"]),
                    'appointment_type_restriction'=> $this->faker->randomElement(["NONE", "PROCEDURE", "CONSULTATION"]),
                    'anesthetist_id'=> $ana2->id,
                ]);
            }
        }
    }
}
