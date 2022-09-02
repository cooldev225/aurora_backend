<?php

namespace App\Enum;

enum DocumentOrigin: string
{
    case CREATED = 'CREATED';
    case RECEIVED = 'RECEIVED';
    case UPLOADED = 'UPLOADED';
}

