<?php

namespace App\Helpers;

use App\Models\Log;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Request;

class LogToDatabase
{
    public function __construct()
    {

    }

    public static function log($log_type_id, $message)
    {
        $event_user_id = 1;
        #$event_date_time = Carbon::now();

        if(Request::ip()){
            $user_ip_address = Request::ip();
        } else {
            $user_ip_address = '127.0.0.1';
        }

        if(Auth::check()){
            $event_user_id = Auth::user()->id;
        }

        $log_details = [
            'log_type_id' => $log_type_id,
            'message' => $message,
            'user_id' => $event_user_id,
            'ip' => $user_ip_address,
        ];

        Log::create($log_details);
    }
}