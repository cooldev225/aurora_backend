<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Clinic;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clinics = Clinic::all();

        foreach ($clinics as $clinic) {
            $rand = mt_rand(1, 5);

            for ($i = 0; $i < $rand; $i++) {
                Room::factory()->create([
                    'organization_id' => $clinic->organization_id,
                    'clinic_id' => $clinic->id,
                ]);
            }
        }
    }
}
