<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Check conflict
     */
    protected function timeContainsSlot(
        $start_time,
        $end_time,
        $slot_start_time,
        $slot_end_time
    ) {
        if ($start_time <= $slot_start_time && $end_time >= $slot_end_time) {
            return true;
        }

        return false;
    }
}
