<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Contracts\CongregationService;
use Carbon\Carbon;

/**
 * The ScheduleController class.
 * @package App\Http\Controllers
 * @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class ScheduleController extends Controller
{
    /**
     * @var CongregationService
     */
    private $congregationService;

    /**
     * ScheduleController constructor.
     *
     * @param CongregationService $congregationService
     */
    public function __construct(CongregationService $congregationService)
    {
        $this->congregationService = $congregationService;
    }

    public function getNew($year, $month, $day)
    {
        $date = Carbon::createFromDate($year, $month, $day);
        $talks = [];
        $this->congregationService->getAllTalks()->map(function ($talk) use (&$talks) {
            $subject = 'Not Defined';
            if ($talk->subjects->count() > 0) {
                $subject = $talk->subjects->first()->subject;
            }
            $talks[$talk->id] = $talk->number . ' - ' . $subject;
        });

        return view('schedules.new-schedule')->with(compact('date', 'talks'));
    }

    public function postNew()
    {
        // TODO Implement me!
    }

}
