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
            'slug' => 'organization-admin',
        ]);

        UserRole::create([
            'name' => 'Practice Manager',
            'slug' => 'practice-manager',
        ]);

        UserRole::create([
            'name' => 'Administration Managers',
            'slug' => 'administration-managers',
        ]);

        UserRole::create([
            'name' => 'Admin Staff',
            'slug' => 'admin-staff',
        ]);

        UserRole::create([
            'name' => 'Specialist',
            'slug' => 'specialist',
        ]);

        UserRole::create([
            'name' => 'Anesthetist',
            'slug' => 'anesthetist',
        ]);

        UserRole::create([
            'name' => 'Scientist',
            'slug' => 'scientist',
        ]);

        UserRole::create([
            'name' => 'Typist',
            'slug' => 'typist',
        ]);
    }
}