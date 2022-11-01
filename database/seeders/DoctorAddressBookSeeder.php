<?php

namespace Database\Seeders;

use App\Models\DoctorAddressBook;
use Illuminate\Database\Seeder;

class DoctorAddressBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorAddressBook::factory(30)->create();
    }
}
