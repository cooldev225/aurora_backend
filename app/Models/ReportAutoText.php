<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAutotext extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'text'];

    /**
     * Return Report Section
     */
    public function section()
    {
        return $this->belongsTo(ReportSection::class, 'section_id');
    }

}
