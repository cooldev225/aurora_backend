<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::factory(100)->create([
            'date' => '2022-06-30',
        ]);

        Appointment::factory(100)->create([
            'date' => date('Y-m-d'),
        ]);
    }
}
