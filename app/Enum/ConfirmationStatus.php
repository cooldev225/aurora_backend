<?php

namespace App\Enum;


enum ConfirmationStatus: string
{
    case PENDING = 'PENDING';
    case CONFIRMED = 'CONFIRMED';
    case CANCELED = 'CANCELED';
    case MISSED = 'MISSED';
}
