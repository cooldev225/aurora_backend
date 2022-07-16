<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    protected $fillable = ['organization_id', 'title'];

    /**
     * Return ReportSection
     */
    public function sections()
    {
        return $this->hasMany(ReportSection::class, 'template_id');
    }
}
