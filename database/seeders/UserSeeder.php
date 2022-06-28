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
        User::factory(100)->create();

        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'role_id' => UserRole::where('slug', 'admin')->first()->id,
        ]);

        User::factory()->create([
            'username' => 'org-admin',
            'email' => 'organizationAdmin@mail.com',
            'role_id' => UserRole::where('slug', 'organizationAdmin')->first()
                ->id,
        ]);

        User::factory()->create([
            'username' => 'org-manager',
            'email' => 'organizationManager@mail.com',
            'role_id' => UserRole::where('slug', 'organizationManager')->first()
                ->id,
        ]);
    }
}
