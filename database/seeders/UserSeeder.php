<?php

namespace Database\Seeders;

use App\Models\HRMUserBaseSchedule;
use App\Models\User;
use App\Models\UserRole;
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
            'role_id'           => UserRole::where('slug', 'admin')->first()->id,
            'organization_id'   => 1,
        ]);

        $org_admin_role = UserRole::where('slug', 'organizationAdmin')
            ->first()->id;

        User::factory()->create([
            'username'          => 'org-admin',
            'email'             => 'organizationAdmin@mail.com',
            'role_id'           => $org_admin_role,
            'organization_id'   => 1,
        ]);

        $org_manager_role = UserRole::where('slug', 'organizationManager')
            ->first()->id;

        User::factory()->create([
            'username'          => 'org-manager',
            'email'             => 'organizationManager@mail.com',
            'role_id'           => $org_manager_role,
            'organization_id'   => 1,
        ]);


        User::factory(50)->create();



        foreach (User::all() as $user) {
            if ($user->role_id == 5) {


                HRMUserBaseSchedule::create([
                    'user_id'   => $user->id,
                    'clinic_id' => $user->organization->clinics->first()->id,
                    'start_time' => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
                    'end_time' => $this->faker->randomElement(['16:00:00', '14:30:00', '12:30:00']),
                    'week_day' => $this->faker->randomElement(["MON", "TUE"]),
                ]);

                HRMUserBaseSchedule::create([
                    'user_id'   => $user->id,
                    'clinic_id' => $user->organization->clinics->first()->id,
                    'start_time' => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
                    'end_time' => $this->faker->randomElement(['16:00:00', '14:30:00', '12:30:00']),
                    'week_day' => $this->faker->randomElement(["WED", "THU"]),
                ]);

                HRMUserBaseSchedule::create([
                    'user_id'   => $user->id,
                    'clinic_id' => $user->organization->clinics->first()->id,
                    'start_time' => $this->faker->randomElement(['07:00:00', '08:30:00', '06:30:00']),
                    'end_time' => $this->faker->randomElement(['16:00:00', '14:30:00', '12:30:00']),
                    'week_day' => $this->faker->randomElement(["FRI", "SAT"]),
                ]);
            }
        }
    }
}
