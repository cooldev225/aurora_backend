<?php

namespace Database\Seeders;

use App\Models\LetterTemplate;
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
        ReportTemplate::factory(14)->create();
        ReportSection::factory(20)->create();
        ReportAutoText::factory(40)->create();

        LetterTemplate::factory(10)->create();
    }
}
