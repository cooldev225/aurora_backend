<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\HrmScheduleTimeslot;
use App\Models\PatientAlert;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProdSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserRoleSeeder::class
        ]);

        User::factory()->create([
            'username'          => 'admin',
            'email'             => 'admin@mail.com',
            'role_id'           => UserRole::ADMIN,
        ]);
    }
}
