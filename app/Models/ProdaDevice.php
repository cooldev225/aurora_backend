<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdaDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name',
        'otac',
        'key_status',
        'key_expiry',
        'device_status',
        'device_expiry',
        'private_key',
        'public_key',
    ];

    protected $hidden = ['private_key'];
}
