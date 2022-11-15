<?php

namespace Database\Factories;

use App\Models\DoctorAddressBook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AppointmentReferralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $referral_date = $this->faker->dateTimeBetween('now', '+1 month');
        $referral_duration = $this->faker->randomElement([0, 3, 12]);
        $referral_expiry_date = date(
            "Y-m-d",
            strtotime("+" . $referral_duration . " months", $referral_date->getTimestamp())
        );

        return [
            'doctor_address_book_id'=> DoctorAddressBook::inRandomOrder()->first()->id,
            'is_no_referral'        => $this->faker->boolean(),
            'no_referral_reason'    => $this->faker->randomElement([
                'EMERGENCY',
                'IN_HOSPITAL',
                'LOST_UNAVAILABLE',
                'NOT_REQUIRED',
            ]),
            'referral_date'         => $referral_date,
            'referral_duration'     => $referral_duration,
            'referral_expiry_date'  => $referral_expiry_date,
        ];
    }
}
