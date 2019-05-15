<?php
function dateUTC($format, $timestamp = null)
{
    if ($timestamp === null) $timestamp = time();

    $tz = date_default_timezone_get();
    date_default_timezone_set('UTC');

    $result = date($format, $timestamp);

    date_default_timezone_set($tz);
    return $result;
}

function timeLocalizer(){
    $tz = date_default_timezone_get();
    date_default_timezone_set($_COOKIE['time_offset']); 
    $timeStamp = strtotime($row["lesson start"].' UTC');

    $row["lesson start"] = date("d.m.y H:i:s", $timeStamp);

    date_default_timezone_set($tz);
}
?>