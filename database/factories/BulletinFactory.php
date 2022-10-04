<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bulletin>
 */
class BulletinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id' => 1,
            'created_by' => User::where('organization_id',1)->inRandomOrder()->first()->id,
            'title' =>  $this->faker->realText(50),
            'body' => '<p>' . $this->faker->paragraph(4, true) . '</p>'.'<p>' . $this->faker->paragraph(8, true) . '</p>'.'<p>' . $this->faker->paragraph(4, true) . '</p>',
           
        ];
    }
}
