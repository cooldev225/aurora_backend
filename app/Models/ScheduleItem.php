<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'mbs_item_code',
        'icd_code',
        'organization_id',
    ];

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Return Schedule fees
     */
    public function schedule_fees()
    {
        return $this->hasMany(ScheduleFee::class);
    }
}
