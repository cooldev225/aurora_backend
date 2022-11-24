<?php

namespace App\Enum;

enum OutMessageSendMethod: string
{
    case HEALTHLINK = 'HEALTHLINK';
    case EMAIL = 'EMAIL';
    case FAX = 'FAX';
    case PRINT = 'PRINT';
}

