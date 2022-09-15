<?php

namespace App\Enum;

enum NotificationMethod: string
{
    case SMS   = 'sms';
    case MAIL  = 'mail';
    case EMAIL = 'email';
}