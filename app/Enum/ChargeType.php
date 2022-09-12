<?php

namespace App\Enum;

Enum ChargeType: string
{
    case SELF_INSURED = 'self-insured';
    case PRIVATE_HEALTH_EXCESS = 'private-health-excess';
    case PRIVATE_HEALTH_EXCESS_0 = 'private-health-excess-0';
    case PRIVATE_HEALTH_PENSION = 'private-health-pension';
    case PENSION_CARD = 'pension-card';
    case HEALTHCARE_CARD = 'healthcare-card';
    case DEPARTMENT_VETERAN = 'department-veteran';
    case WORK_COVER = 'work-cover';
    case TRANSPORT_ACCIDENT = 'transport-accident';
}