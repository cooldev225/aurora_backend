<?php

namespace App\Enum;

enum DocumentActionStatusType: string
{
    case EMAILED = 'EMAILED';
    case PRINTED = 'PRINTED';
    case FAXED = 'FAXED';
}

