<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        UserRole::create([
            'name' => 'Organization Admin',
            'slug' => 'organizationAdmin',
        ]);

        UserRole::create([
            'name' => 'Organization Manager',
            'slug' => 'organizationManager',
        ]);

        UserRole::create([
            'name' => 'Receptionist',
            'slug' => 'receptionist',
        ]);

        UserRole::create([
            'name' => 'Specialist',
            'slug' => 'specialist',
        ]);

        UserRole::create([
            'name' => 'Pathologist',
            'slug' => 'pathologist',
        ]);

        UserRole::create([
            'name' => 'Scientist',
            'slug' => 'scientist',
        ]);

        UserRole::create([
            'name' => 'Typist',
            'slug' => 'typist',
        ]);

        UserRole::create([
            'name' => 'Anesthetist',
            'slug' => 'anesthetist',
        ]);
    }
}
