<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreAdmissionSection extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'title'];

    /**
     * Return Section's questions
     */
    public function questions()
    {
        return $this->hasMany(PreAdmissionQuestion::class);
    }

    public static function createSection($data)
    {
        $sectionObj = self::create($data);

        $questions = $data['questions'];
        $arrQuestionsData = $questions;

        if (is_array($arrQuestionsData)) {
            foreach ($arrQuestionsData as $question) {
                $question = (object) $question;
                $questionObj = new PreAdmissionQuestion();
                $questionObj->pre_admission_section_id = $sectionObj->id;
                $questionObj->text = $question->text;
                $questionObj->answer_format = $question->answer_format;
                $questionObj->save();
            }
        }

        return self::where('id', $sectionObj->id)
            ->with('questions')
            ->first();
    }

    public function update(array $attributes = [], array $options = [])
    {
        parent::update($attributes, $options);

        $questions = $attributes['questions'];
        $arrQuestionsData = $questions;

        $arrQuestionID = [];

        if (is_array($arrQuestionsData)) {
            foreach ($arrQuestionsData as $question) {
                $question = (object) $question;
                $questionObj = null;
                if (isset($question->id)) {
                    $questionObj = PreAdmissionQuestion::where(
                        'pre_admission_section_id',
                        $this->id
                    )
                        ->where('id', $question->id)
                        ->first();
                }

                if ($questionObj == null) {
                    $questionObj = new PreAdmissionQuestion();
                    $questionObj->pre_admission_section_id = $this->id;
                }

                $questionObj->text = $question->text;
                $questionObj->answer_format = $question->answer_format;
                $questionObj->save();
                $arrQuestionID[] = $questionObj->id;
            }
        }

        PreAdmissionQuestion::where('pre_admission_section_id', $this->id)
            ->whereNotIn('id', $arrQuestionID)
            ->delete();

        return PreAdmissionSection::where('id', $this->id)
            ->with('questions')
            ->first();
    }

    public function delete()
    {
        $this->questions()->delete();

        parent::delete();
    }
}
