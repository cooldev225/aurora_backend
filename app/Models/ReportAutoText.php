<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportAutotext extends Model
{
    protected $fillable = ['section_id', 'text'];

    /**
     * Return Report Section
     */
    public function section()
    {
        return $this->belongsTo(ReportSection::class, 'section_id');
    }

}
