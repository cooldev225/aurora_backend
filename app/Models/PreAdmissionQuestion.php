<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreAdmissionQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'pre_admission_section_id', 'text', 'answer_format'
    ];

    /**
     * Return Section
     */
    public function section() {
        return $this->belongsTo(PreAdmissionSection::class);
    }
}
