<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreAdmissionSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'title'
    ];

    /**
     * Return Section's questions
     */
    public function questions() {
        return $this->hasMany(PreAdmissionQuestion::class);
    }
}
