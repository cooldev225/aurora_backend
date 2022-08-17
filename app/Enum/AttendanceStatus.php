<?php

namespace App\Enum;


enum AttendanceStatus: string
{
    case NOT_PRESENT = 'NOT_PRESENT';
    case WAITING = 'WAITING';
    case CHECKED_IN = 'CHECKED_IN';
    case CHECKED_OUT = 'CHECKED_OUT';

}
