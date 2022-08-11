<?php

namespace App\Enum;


enum ProcedureApprovalStatus: string
{
    case NOT_RELEVANT = 'NOT_RELEVANT';
    case NOT_ACCESSED = 'NOT_ACCESSED';
    case NOT_APPROVED = 'NOT_APPROVED';
    case APPROVED = 'APPROVED';
    case CONSULT_REQUIRED = 'CONSULT_REQUIRED';
}
