<?php

namespace Database\Seeders;

use App\Models\HrmScheduleTimeslot;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserRoleSeeder::class,
            OrganizationSeeder::class,
            AppointmentTypeSeeder::class,
            ClinicSeeder::class,
            RoomSeeder::class,
            UserSeeder::class,
            PatientSeeder::class,
            HealthFundSeeder::class,
            AnestheticQuestionSeeder::class,
            ReferringDoctorSeeder::class,
            HrmScheduleTimeslotSeeder::class,
            AppointmentSeeder::class,
            AppointmentTimeRequirementSeeder::class,
            NotificationTemplateSeeder::class,
            ReportTemplateSeeder::class,
            PatientDocumentSeeder::class,
            PreAdmissionSeeder::class,
            ScheduleFeeSeeder::class,
            BulletinSeeder::class,
        ]);
    }
}
