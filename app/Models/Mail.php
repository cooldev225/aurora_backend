<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'from_user_id',
        'to_user_ids',
        'body',
        'reply_id',
        'thread_id',
        'status',
        'sent_at',
        'attachment',
    ];

    /**
     * Return Mailbox
     */
    public function mailbox()
    {
        return $this->hasOne(Mailbox::class, 'mail_id');
    }
}
