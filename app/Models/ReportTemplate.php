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

    public static function createTemplate($data)
    {
        $templateObj = self::create($data);

        $templateSections = $data['sections'];

        if (is_array($templateSections)) {
            foreach ($templateSections as $section) {
                $section = (object) $section;

                $sectionObj = new ReportSection();
                $sectionObj->template_id = $templateObj->id;
                $sectionObj->title = $section->title;
                $sectionObj->free_text_default = $section->free_text_default;
                $sectionObj->is_image = isset($section->is_image)
                    ? $sectionObj->is_image
                    : false;
                $sectionObj->save();

                foreach ($section->auto_texts as $autoText) {
                    $autoText = (object) $autoText;

                    $autoTextObj = new ReportAutoText();
                    $autoTextObj->section_id = $sectionObj->id;
                    $autoTextObj->text = $autoText->text;
                    $autoTextObj->save();
                }
            }
        }

        return self::where('id', $templateObj->id)
            ->with('sections')
            ->with('sections.autoTexts')
            ->first();
    }

    public function update(array $attributes = [], array $options = [])
    {
        parent::update($attributes, $options);

        $templateSections = $attributes['sections'];

        if (is_array($templateSections)) {
            $arrSectionID = [];
            foreach ($templateSections as $section) {
                $section = (object) $section;
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
                $sectionObj->free_text_default = $section->free_text_default;
                $sectionObj->is_image = isset($section->is_image)
                    ? $sectionObj->is_image
                    : false;
                $sectionObj->save();
                $arrSectionID[] = $sectionObj->id;

                $arrAutoTextId = [];
                foreach ($section->auto_texts as $autoText) {
                    $autoText = (object) $autoText;
                    $autoTextObj = null;
                    if (isset($autoText->id)) {
                        $autoTextObj = ReportAutoText::where(
                            'section_id',
                            $sectionObj->id
                        )
                            ->where('id', $autoText->id)
                            ->first();
                    }

                    if ($autoTextObj == null) {
                        $autoTextObj = new ReportAutoText();
                        $autoTextObj->section_id = $sectionObj->id;
                    }

                    $autoTextObj->text = $autoText->text;
                    $autoTextObj->save();
                    $arrAutoTextId[] = $autoTextObj->id;
                }

                ReportAutoText::where('section_id', $sectionObj->id)
                    ->whereNotIn('id', $arrAutoTextId)
                    ->delete();
            }

            $arrDeletingSectionId = ReportSection::where(
                'template_id',
                $this->id
            )
                ->whereNotIn('id', $arrSectionID)
                ->pluck('id');

            ReportAutoText::whereIn(
                'section_id',
                $arrDeletingSectionId
            )->delete();
            ReportSection::whereIn('id', $arrDeletingSectionId)->delete();
        }

        return ReportTemplate::where('id', $this->id)
            ->with('sections')
            ->with('sections.autoTexts')
            ->first();
    }

    public function delete()
    {
        $arrSectionID = [];
        $arrSections = $this->sections;

        foreach ($arrSections as $section) {
            $arrSectionID[] = $section->id;
        }

        $this->sections()->delete();
        ReportAutoText::whereIn('section_id', $arrSectionID)->delete();

        parent::delete();
    }
}
