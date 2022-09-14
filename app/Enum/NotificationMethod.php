<?php

namespace App\Enum;

enum NotificationMethod: string
{
    case SMS   = 'SMS';
    case MAIL  = 'MAIL';
    case EMAIL = 'EMAIL';
}