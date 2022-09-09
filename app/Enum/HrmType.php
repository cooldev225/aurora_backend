<?php

namespace App\Enum;

enum HrmType: string
{
    case NONE = 'NONE';
    case MANAGER = 'MANAGER';
    case EMPLOYEE = 'EMPLOYEE';
}