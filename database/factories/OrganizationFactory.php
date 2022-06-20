<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProvaDevice;
use App\Models\User;
use App\Models\UserRole;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $owner = User::factory()->create([
            'role_id' => UserRole::where('slug', 'organization-admin')
                ->limit(1)
                ->get()[0]->id,
        ]);

        $prova_device = ProvaDevice::factory()->create();

        return [
            'name' => $this->faker->title(),
            'logo' => $this->faker->imageUrl(),
            'max_clinics' => mt_rand(1, 9999),
            'max_employees' => mt_rand(1, 9999),
            'prova_device_id' => $prova_device->id,
            'owner_id' => $owner->id,
        ];
    }
}
