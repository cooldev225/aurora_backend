<?php

namespace Database\Seeders;

use App\Models\ReportAutoText;
use App\Models\ReportSection;
use App\Models\ReportTemplate;
use Illuminate\Database\Seeder;

class ReportTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportTemplate::factory(6)->create();
        ReportSection::factory(10)->create();
        ReportAutoText::factory(30)->create();
    }
}
