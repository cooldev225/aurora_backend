<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    /**
     * Return User
     */
    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }
}
