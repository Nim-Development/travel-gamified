<?php

namespace App\Modules\Time;

class TimeConverter
{
    public $days;
    public $hours;
    public $minutes;

    public function getDays()
    {
        return $this->days;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function getMinutes()
    {
        return $this->minutes;
    }

    public function clear()
    {
        $this->days = 0;
        $this->hours = 0;
        $this->minutes = 0;
    }

    public function dhmToSeconds($days, $hours, $minutes){

        if(!$days || !$hours || !$minutes){


            return false;
        }

        $secondsInADay = 86400;
        $secondsInAHour = 3600;
        $secondsInAMinute = 60;

        $daysToSeconds = $days * $secondsInADay;
        $hoursToSeconds = $hours * $secondsInAHour;
        $minutesToSeconds = $minutes * $secondsInAMinute;
     
        return ($daysToSeconds + $hoursToSeconds + $minutesToSeconds);
    }

    public function secondsToDhm($inputSeconds){

        if(!$inputSeconds){

            return false;
        }

        $secondsInAMinute = 60;
        $secondsInAnHour  = 60 * $secondsInAMinute;
        $secondsInADay    = 24 * $secondsInAnHour;
     
        // extract days
        $days = floor($inputSeconds / $secondsInADay);
     
        // extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);
     
        // extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);
     
        // extract the remaining seconds
        // $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        // $seconds = ceil($remainingSeconds);
     
        $this->days = (int) $days;
        $this->hours = (int) $hours;
        $this->minutes = (int) $minutes;
        
    }
}

