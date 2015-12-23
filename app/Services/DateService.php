<?php

namespace App\Services;


use Carbon\Carbon;

/**
 * Class DateService
 * @package App\Services
 */
class DateService implements Contracts\DateService
{

    /**
     * Get days of week.
     * @return mixed
     */
    public function getDaysOfWeek()
    {
        return [
            Carbon::MONDAY    => 'Monday',
            Carbon::TUESDAY   => 'Tuesday',
            Carbon::WEDNESDAY => 'Wednesday',
            Carbon::THURSDAY  => 'Thursday',
            Carbon::FRIDAY    => 'Friday',
            Carbon::SATURDAY  => 'Saturday',
            Carbon::SUNDAY    => 'Sunday',
        ];
    }

    /**
     * Get hours.
     * @return mixed
     */
    public function getHours()
    {
        $hours = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $hours[$hour] = $hour;
        }
        return $hours;
    }

    /**
     * Get minutes.
     * @return mixed
     */
    public function getMinutes()
    {
        $minutes = [];
        for ($minute = 0; $minute < 60; $minute += 5) {
            $minutes[$minute] = $minute;
        }
        return $minutes;
    }


}