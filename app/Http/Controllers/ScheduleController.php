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

        // Get talks.
        $talks = [];
        $this->congregationService->getAllTalks()->each(function ($talk) use (&$talks) {
            $subject = 'Not Defined';
            if ($talk->subjects->count() > 0) {
                $subject = $talk->subjects->first()->subject;
            }
            $talks[$talk->id] = $talk->number . ' - ' . $subject;
        });

        // Get speakers.
        $speakers = [];
        $this->congregationService->getAllSpeakers()->each(function ($speaker) use (&$speakers) {
            $speakers[$speaker->id] = $speaker->first_name . ' ' . $speaker->last_name . ' (' . $speaker->congregation->name . ')';
        });
        $speakers = collect($speakers)->sort();

        // Map prepared talks by speakers.
        $prepared_talks_by_speakers = [];
        $this->congregationService->getAllSpeakers()->each(function ($speaker) use (&$prepared_talks_by_speakers) {
            $prepared_talks_by_speakers[$speaker->id] = $speaker->preparedTalks->pluck('talk_id')->toArray();
        });

        return view('schedules.new-schedule')->with(compact('date', 'talks', 'speakers', 'prepared_talks_by_speakers'));
    }

    public function postNew()
    {
        // TODO Implement me!
    }

}
