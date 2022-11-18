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
        'internal_code',
        'organization_id',
    ];
    
    protected $appends = [
        'label_name',
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

    public function getLabelNameAttribute()
    {
        $name = [];

        if ($this->mbs_item_code) {
            $name[] = $this->mbs_item_code;
        }

        if ($this->internal_code) {
            $name[] = $this->internal_code;
        }

        $name[] = $this->name;

        return implode(' - ', $name);
    }
}
