<?php

namespace App\Enum;

enum PatientGender: int
{
    case MALE = 1;
    case FEMALE = 2;
    case OTHER = 3;
    case NOT_STATED = 9;
}