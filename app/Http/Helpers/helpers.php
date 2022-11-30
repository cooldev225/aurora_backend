<?php

if (!function_exists('getAbsoluteUrl')) {
    function getAbsoluteUrl()
    {
        if (str_contains(env('APP_URL'), 'localhost')) {
            return 'http://localhost:8080';
        }

        return env('APP_URL');
    }
}