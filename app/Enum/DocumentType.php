<?php

namespace App\Enum;

enum DocumentType: string
{
    case LETTER = 'LETTER';
    case REPORT = 'REPORT';
    case CLINICAL_NOTE = 'CLINICAL_NOTE';
    case PATHOLOGY_REPORT = 'PATHOLOGY_REPORT';
    case REFERRAL = 'REFERRAL';
    case AUDIO = 'AUDIO';
    case USB_CAPTURE = 'USB_CAPTURE';
    case OTHER = 'OTHER';

}

