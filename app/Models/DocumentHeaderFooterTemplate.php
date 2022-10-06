<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentHeaderFooterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'title', 'header_file', 'footer_file', 'is_organization_default'
    ];

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
