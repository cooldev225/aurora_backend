<?php

if (!function_exists('generateInvoiceNumber')) {
    function generateInvoiceNumber($organization, $appointment, $number = null)
    {
        $code = strtoupper($organization->code);
        $appointment_number = sprintf('%05d', $appointment->id);
        $digits = sprintf('%07d', $organization->id . $appointment_number);

        return $code . $digits . $number;
    }
}