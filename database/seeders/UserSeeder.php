<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
