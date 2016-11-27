<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Tracker;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function checkAuthOfTracker(Tracker $tracker)
    {
        $authenticated = FALSE;

        if ($tracker->hasOwner()) {

            /* Checking the owner of tracker */
            if (Auth::check() && Auth::user()->id == $tracker->owner_id) {
                $authenticated = TRUE;
            }

        } else {
            /* Allow auth for non ownership of tracker */
            $authenticated = TRUE;
        }

        return $authenticated;
        
    }
}
