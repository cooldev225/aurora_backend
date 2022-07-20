<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'heading', 'body'
    ];

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
