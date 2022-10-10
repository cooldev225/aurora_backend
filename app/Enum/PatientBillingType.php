<?php

namespace App\Enum;

enum PatientBillingType: int
{
    case MEDICARE_CARD = 1;
    case HEALTH_FUND = 2;
    case DVA = 3;
    case OTHER = 0;
}