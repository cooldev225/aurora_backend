<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'specialist_title_id',
        'specialist_type_id',
    ];

    /**
     * Return User
     */
    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }
}
