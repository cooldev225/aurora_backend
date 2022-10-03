<?php

namespace App\Enum;

enum FileType: string
{
    case REFERRAL = 'referral';
    case PRE_ADMISSION = 'pre_admission';
    case PATIENT_DOCUMENT = 'patient_document';
    case ORGANIZATION_LOGO = 'logo_organization';
    case USER_PHOTO = 'user_photo';
    case DOCUMENT_HEADER = 'document_header';
    case DOCUMENT_FOOTER = 'document_footer';

}