<?php

namespace Database\Seeders;

use App\Models\Bulletin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BulletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bulletin::factory(10)->create();

    }
}
