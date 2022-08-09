<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationTemplate;
use App\Models\Organization;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = Organization::all();

        foreach ($organizations as $organization) {
            NotificationTemplate::CreateOrganizationNotification($organization);
        }
    }
}
