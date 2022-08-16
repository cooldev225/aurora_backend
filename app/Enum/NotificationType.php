<?php

namespace App\Enum;


enum NotificationType: string
{
    case APPOINTMENT_BOOKED = 'appointment_booked';
    case PROCEDURE_DENIED = 'procedure_denied';
    case PROCEDURE_APPROVED = 'procedure_approved';
    case RECALL = 'recall';
    case APPOINTMENT_REMINDER = 'appointment_reminder';
    case APPOINTMENT_CONFIRMATION = 'appointment_confirmation';
 
}
