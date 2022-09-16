<?php

namespace App\Enum;

enum FileType: string
{
    case REFERRAL = 'referral';
    case PRE_ADMISSION = 'pre_admission';
    case PATIENT_DOCUMENT = 'patient_document';
}