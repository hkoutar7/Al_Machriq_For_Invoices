<?php

use Carbon\Carbon;

if (! function_exists('date_now')) {
    function date_now()
    {
        $now = Carbon::parse(now())->format('m/d/Y') ;
        return $now;
    }
}


if (! function_exists('userName')) {
    function userName()
    {
    $name = auth()->user()->name;
        return $name;
    }
}

if (! function_exists('userID')) {
    function userID()
    {
        $id = auth()->user()->id;
        return $id;
    }
}

