<?php

namespace App\Enum;

enum PaymentType: string
{
    case CASH   = 'CASH';
    case EFTPOS = 'EFTPOS';
}