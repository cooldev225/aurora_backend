<?php

namespace App\Enum;

enum UserRole: int
{
    case ADMIN = 1;
    case ORGANIZATION_ADMIN = 2;
    case ORGANIZATION_MANAGER = 3;
    case RECEPTIONIST = 4;
    case SPECIALIST = 5;
    case PATHOLOGIST = 6;
    case SCIENTIST = 7;
    case TYPIST = 8;
    case ANESTHETIST = 9;
}