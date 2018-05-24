<?php

namespace App\Services;

class ConvertTime{
    public static function convertToSec($time){
        $dot = strrpos($time, ":");
        $hours = substr($time, 0 , $dot);
        $minutes = substr($time, $dot+1);
        $secs = ($hours*3600)+($minutes*60);

        return $secs;
    }

    public static function convertToTime($secs){
        $time = $secs/3600;
        $dot = strrpos($time, ".");        
        $hours = substr($time, 0 , $dot);
        $min = substr($time, $dot);
        $minutes = round($min*60);
        return $hours." horas e ".$minutes." minutos";
    }
}
