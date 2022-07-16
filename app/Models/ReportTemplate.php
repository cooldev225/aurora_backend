<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'title'];

    /**
     * Return ReportSection
     */
    public function sections()
    {
        return $this->hasMany(ReportSection::class, 'template_id');
    }
}
