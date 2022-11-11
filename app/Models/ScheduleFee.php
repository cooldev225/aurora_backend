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
        'schedule_item_id',
    ];

    /**
     * Return Schedule Item
     */
    public function schedule_item()
    {
        return $this->belongsTo(ScheduleItem::class);
    }
}
