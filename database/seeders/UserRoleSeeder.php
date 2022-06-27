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
            'hrm_type' => 'manager',
        ]);

        UserRole::create([
            'name' => 'Organization Manager',
            'slug' => 'organizationManager',
            'hrm_type' => 'manager',
        ]);

        UserRole::create([
            'name' => 'Receptionist',
            'slug' => 'receptionist',
            'hrm_type' => 'employee',
        ]);

        UserRole::create([
            'name' => 'Specialist',
            'slug' => 'specialist',
            'hrm_type' => 'employee',
        ]);

        UserRole::create([
            'name' => 'Pathologist',
            'slug' => 'pathologist',
            'hrm_type' => 'employee',
        ]);

        UserRole::create([
            'name' => 'Scientist',
            'slug' => 'scientist',
            'hrm_type' => 'employee',
        ]);

        UserRole::create([
            'name' => 'Typist',
            'slug' => 'typist',
            'hrm_type' => 'employee',
        ]);

        UserRole::create([
            'name' => 'Anesthetist',
            'slug' => 'anesthetist',
            'hrm_type' => 'employee',
        ]);
    }
}
