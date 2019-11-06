<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

Trait ShowMessages {


    public static function showMessage($message, $type = "success")
    {
        Session::flash("sysMessage", $message);
        Session::flash("msgType", $type);
    }

}
