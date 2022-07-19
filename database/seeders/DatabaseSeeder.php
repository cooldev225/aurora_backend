<?php

namespace Database\Seeders;

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
            ProdaDeviceSeeder::class,
            RoomSeeder::class,
            UserSeeder::class,
            PatientSeeder::class,
            EmployeeSeeder::class,
            SpecialistSeeder::class,
            PatientOrganizationSeeder::class,
            HealthFundSeeder::class,
            AnestheticQuestionSeeder::class,
            ProcedureQuestionSeeder::class,
            // AppointmentAdministrationInfoSeeder::class,
            AppointmentTimeRequirementSeeder::class,
            NotificationTemplateSeeder::class,
            ReportTemplateSeeder::class,
            PatientDocumentSeeder::class,
        ]);
    }
}
