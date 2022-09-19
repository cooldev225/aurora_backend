<?php

namespace App\Enum;

enum FileType: string
{
    case REFERRAL = 'referral';
    case PRE_ADMISSION = 'pre_admission';
    case PATIENT_DOCUMENT = 'patient_document';
    case CLINIC_HEADER = 'header_clinic';
    case CLINIC_FOOTER = 'footer_clinic';
    case ORGANIZATION_LOGO = 'logo_organization';
    case ORGANIZATION_HEADER = 'header_organization';
    case ORGANIZATION_FOOTER = 'footer_organization';
    case USER_PHOTO = 'user_photo';
}