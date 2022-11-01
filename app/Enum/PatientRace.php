<?php

namespace App\Enum;

enum PatientRace: int
{
    case RACE1 = 1; //"Aboriginal but not Torres Strait Islander origin"
    case RACE2 = 2; //"Torres Strait Islander but not Aboriginal origin"
    case RACE3 = 3; //"Aboriginal and Torres Strait Islander origin"
    case RACE4 = 4; //"Neither Aboriginal nor Torres Strait Islander origin"
    case RACE9 = 9; //"Not Stated"
}
