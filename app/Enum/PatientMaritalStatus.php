<?php

namespace App\Enum;

enum PatientMaritalStatus: int
{
    case SINGLE = 1;
    case MARRIED = 2;
    case NOT_STATED = 3;
    case DIVORCED = 4;
    case WIDOWED = 5;
    case NEVER_MARRIED = 6;
    case SEPARATED = 7;
    case DE_FACTO = 9;
}
