<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CongregationService;
use App\Services\Contracts\DateService;
use Carbon\Carbon;

/**
 * The CalendarController class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CalendarController extends Controller
{
    /**
     * The congregation service.
     * @var CongregationService
     */
    protected $congregationService;
    /**
     * @var DateService
     */
    private $dateService;

    # Constructor.

    /**
     * Construct a CalendarController.
     *
     * @param CongregationService $congregationService The congregation service.
     * @param DateService         $dateService         The date service.
     */
    public function __construct(CongregationService $congregationService, DateService $dateService)
    {
        $this->congregationService = $congregationService;
        $this->dateService = $dateService;
    }

    # Actions.

    /**
     * View calendar for a month.
     *
     * @param number $year  The year.
     * @param number $month The month.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar($year = null, $month = null)
    {

        if (!isset($year) || !isset($month)) {
            $current = Carbon::now();

            return redirect()->route('calendar', ['month' => $current->month, 'year' => $current->year]);
        }

        $current = Carbon::createFromDate($year, $month);
        $calendar = $this->congregationService->getCalendar($current);
        $days_of_week = $this->dateService->getDaysOfWeek();

        return view('calendar')->with([
            'calendar'     => $calendar,
            'current'      => $current,
            'previous'     => $current->copy()->subMonth(),
            'next'         => $current->copy()->addMonth(),
            'today'        => Carbon::now(),
            'days_of_week' => $days_of_week,
        ]);
    }
}
