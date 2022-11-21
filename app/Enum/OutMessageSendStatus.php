<?php

namespace App\Enum;

enum OutMessageSendStatus: string
{
    case PENDING = 'PENDING';
    case SENT = 'SENT';
    case FAILED = 'FAILED';
}

