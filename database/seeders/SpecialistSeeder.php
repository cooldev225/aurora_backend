<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialist;
use App\Models\Organization;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialist::factory(10)->create();

        $specialists = Specialist::all();
        $organization_count = Organization::count();

        foreach ($specialists as $specialist) {
            $user = $specialist->employee()->user();

            $user->organization_id = $specialist->id % $organization_count + 1;

            $user->save();
        }

        $specialist = Specialist::factory()->create();
        $user = $specialist->employee()->user();

        $user->username = 'specialist';
        $user->email = 'sepcialist@mail.com';

        $user->save();
    }
}
