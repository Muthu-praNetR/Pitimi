<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CongregationService;
use Carbon\Carbon;

/**
 * The CalendarController class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CalendarController extends Controller
{
    /**
     * The congregation service.
     *
     * @var CongregationService
     */
    protected $congregationService;

    # Constructor.

    /**
     * Construct a CalendarController.
     *
     * @param CongregationService $congregationService The congregation service.
     */
    public function __construct(CongregationService $congregationService)
    {
        $this->congregationService = $congregationService;
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

        // Determine first day of calendar month.
        $start = Carbon::createFromDate($year, $month)->startOfMonth();
        $current = $start->copy();
        $week_start_on = Carbon::MONDAY;

        if ($start->dayOfWeek != $week_start_on) {
            $start->previous($week_start_on);
        }

        // Generate all calendar month dates.
        $date = $start->copy();
        $calendar = [];
        do {
            for ($i = 0; $i < 7; ++$i) {
                $calendar[] = [
                    'date' => $date,
                    'inMonth' => $date->month == $current->month,
                ];
                $date = $date->copy()->addDay();
            }
        } while ($date->month == $current->month);

        return view('calendar')->with([
            'calendar' => $calendar,
            'current' => $current,
            'previous' => $current->copy()->subMonth(),
            'next' => $current->copy()->addMonth(),
        ]);
    }
}
