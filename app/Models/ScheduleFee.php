<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'health_fund_code',
        'mbs_item_code',
        'organization_id',
    ];

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
