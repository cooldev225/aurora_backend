<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'title'];

    /**
     * Return ReportSection
     */
    public function sections()
    {
        return $this->hasMany(ReportSection::class, 'template_id');
    }

    public static function createTemplate($data) {
        $templateObj = self::create($data);

        $template_data = $data['template_data'];
        $arrTemplateData = json_decode($template_data);

        if (is_array($arrTemplateData)) {
            foreach ($arrTemplateData as $section) {
                $sectionObj = new ReportSection();
                $sectionObj->template_id = $templateObj->id;
                $sectionObj->title = $section->title;
                $sectionObj->is_image = $section->is_image;
                $sectionObj->save();

                foreach ($section->autotexts as $autotext) {
                    $autotextObj = new ReportAutotext();
                    $autotextObj->section_id = $sectionObj->id;
                    $autotextObj->text = $autotext->text;
                    $autotextObj->save();
                }
            }
        }

        return self::where('id', $templateObj->id)
            ->with('sections')
            ->with('sections.autotexts')
            ->first();
    }

    public function update(array $attributes = [], array $options = []) {
        parent::update($attributes, $options);

        $template_data = $attributes['template_data'];
        $arrTemplateData = json_decode($template_data);

        if (is_array($arrTemplateData)) {
            $arrSectionID = array();
            foreach ($arrTemplateData as $section) {
                $sectionObj = null;
                if (isset($section->id)) {
                    $sectionObj = ReportSection::where('template_id', $this->id)
                        ->where('id', $section->id)
                        ->first();
                }

                if ($sectionObj == null) {
                    $sectionObj = new ReportSection();
                    $sectionObj->template_id = $this->id;
                }
                
                $sectionObj->title = $section->title;
                $sectionObj->is_image = $section->is_image;
                $sectionObj->save();
                $arrSectionID[] = $sectionObj->id;

                $arrAutotextId = array();
                foreach ($section->autotexts as $autotext) {
                    $autotextObj = null;
                    if (isset($autotext->id)) {
                        $autotextObj = ReportAutotext::where('section_id', $sectionObj->id)
                            ->where('id', $autotext->id)
                            ->first();
                    }

                    if ($autotextObj == null) {
                        $autotextObj = new ReportAutotext();
                        $autotextObj->section_id = $sectionObj->id;
                    }
                    
                    $autotextObj->text = $autotext->text;
                    $autotextObj->save();
                    $arrAutotextId[] = $autotextObj->id;
                }

                ReportAutotext::where('section_id', $sectionObj->id)
                    ->whereNotIn('id', $arrAutotextId)
                    ->delete();
            }

            $arrDeletingSectionId = ReportSection::where('template_id', $this->id)
                ->whereNotIn('id', $arrSectionID)
                ->pluck('id');

            ReportAutotext::whereIn('section_id', $arrDeletingSectionId)->delete();
            ReportSection::whereIn('id', $arrDeletingSectionId)->delete();
        }

        return ReportTemplate::where('id', $this->id)
            ->with('sections')
            ->with('sections.autotexts')
            ->first();
    }

    public function delete() {
        $arrSectionID = array();
        $arrSections = $this->sections;
        
        foreach ($arrSections as $section) {
            $arrSectionID[] = $section->id;
        }

        $this->sections()->delete();
        ReportAutotext::whereIn('section_id', $arrSectionID)
            ->delete();

        parent::delete();
    }
}
