<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmEmployeeLeave extends Model
{
    use HasFactory;
    protected $appends = [
        'full_name'
    ];
    protected $fillable = ['user_id', 'organization_id', 'description', 'status', 'leave_type','start_date', 'end_date', 'full_day', 'start_time', 'end_time' ];

    public function getFullNameAttribute()
    {
        return $this->user->title .' '. $this->user->first_name .' '. $this->user->last_name;

    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
