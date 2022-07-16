<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportSection extends Model
{
    protected $fillable = ['template_id', 'title','is_image'];

    /**
     * Return Report Template
     */
    public function template()
    {
        return $this->belongsTo(ReportTemplate::class, 'template_id');
    }

    /**
     * Return Report Autotext
     */
    public function autotexts()
    {
        return $this->hasMany(ReportAutotext::class, 'section_id');
    }
}
