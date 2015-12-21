<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Contracts\CongregationService;
use Carbon\Carbon;

/**
 * Class ScheduleController
 * @package App\Http\Controllers
 */
class ScheduleController extends Controller
{
    /**
     * @var CongregationService
     */
    private $congregationService;

    /**
     * ScheduleController constructor.
     * @param CongregationService $congregationService
     */
    public function __construct(CongregationService $congregationService)
    {
        $this->congregationService = $congregationService;
    }

    public function getNew($year, $month, $day)
    {
        $date = Carbon::createFromDate($year, $month, $day);
        return view('schedules.new-schedule')->with(compact('date'));
    }

    public function postNew()
    {
        // TODO Implement me!
    }

}
