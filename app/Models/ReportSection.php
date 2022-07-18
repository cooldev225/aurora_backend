<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    use HasFactory;

    protected $fillable = ['template_id', 'title','is_image'];

    /**
     * Return Report Template
     */
    public function template()
    {
        return $this->belongsTo(ReportTemplate::class, 'template_id');
    }

    /**
     * Return Report AutoText
     */
    public function autoTexts()
    {
        return $this->hasMany(ReportAutoText::class, 'section_id');
    }
}
