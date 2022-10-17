<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAutoText extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'text','icd_10_code'];

    /**
     * Return Report Section
     */
    public function section()
    {
        return $this->belongsTo(ReportSection::class, 'section_id');
    }

}
