<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvaDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name',
        'otac',
        'private_key',
        'public_key',
        'key_status',
        'key_expiry',
        'device_status',
        'device_expiry',
    ];
}
