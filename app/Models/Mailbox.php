<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mail_id',
        'status',
        'is_read',
        'is_starred',
    ];

    /**
     * Return Mail
     */
    public function mail()
    {
        return $this->belongsTo(Mail::class, 'mail_id');
    }
}
