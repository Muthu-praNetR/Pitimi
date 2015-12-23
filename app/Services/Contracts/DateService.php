<?php

namespace App\Services\Contracts;

/**
 * The DateService contract.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
interface DateService
{
    /**
     * Get days of week.
     * @return mixed
     */
    public function getDaysOfWeek();

    /**
     * Get hours.
     * @return mixed
     */
    public function getHours();

    /**
     * Get minutes.
     * @return mixed
     */
    public function getMinutes();
}
