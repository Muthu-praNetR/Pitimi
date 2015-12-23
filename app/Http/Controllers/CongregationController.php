<?php

namespace App\Http\Controllers;

use App\Congregation;
use App\Services\Contracts\AdminService;
use App\Services\Contracts\DateService;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class CongregationController
 * @package App\Http\Controllers
 */
class CongregationController extends Controller
{
    /**
     * @var AdminService
     */
    private $adminService;
    /**
     * @var DateService
     */
    private $dateService;

    /**
     * CongregationController constructor.
     *
     * @param AdminService $adminService
     * @param DateService  $dateService
     */
    public function __construct(AdminService $adminService, DateService $dateService)
    {
        $this->adminService = $adminService;
        $this->dateService = $dateService;
    }

    public function getList()
    {
        $congregations = $this->adminService->getCongregations();
        return view('congregations.list-congregations')->with(compact('congregations'));
    }

    public function getNew()
    {
        $days_of_week = $this->dateService->getDaysOfWeek();
        $hours = $this->dateService->getHours();
        $minutes = $this->dateService->getMinutes();
        return view('congregations.new-congregation')->with(compact('days_of_week', 'hours', 'minutes'));
    }

    public function postNew(Request $request)
    {
        // Get input data.
        $name = $request->input('name');
        $is_group = $request->input('is_group') === 'true';
        $public_meeting_day_of_week = $request->input('public_meeting_day_of_week');
        $public_meeting_time_hour = $request->input('public_meeting_time_hour');
        $public_meeting_time_minute = $request->input('public_meeting_time_minute');

        // Set public meeting date and time.
        $public_meeting_at = Carbon::now();
        $public_meeting_at->next($public_meeting_day_of_week);
        $public_meeting_at->hour = $public_meeting_time_hour;
        $public_meeting_at->minute = $public_meeting_time_minute;

        $congregation = new Congregation();
        $congregation->name = $name;
        $congregation->is_group = $is_group;
        $congregation->public_meeting_at = $public_meeting_at;

        $this->adminService->createCongregation($congregation);

        return redirect()->route('list-congregations');
    }

    public function getEdit($id)
    {
        $congregation = $this->adminService->getCongregation($id);
        return view('congregations.edit-congregation', $this->getNew()->getData())
            ->with(compact('congregation'));
    }

    public function postEdit($id, Request $request)
    {
        // Get input data.
        $name = $request->input('name');
        $is_group = $request->input('is_group') === 'true';
        $public_meeting_day_of_week = $request->input('public_meeting_day_of_week');
        $public_meeting_time_hour = $request->input('public_meeting_time_hour');
        $public_meeting_time_minute = $request->input('public_meeting_time_minute');

        // Set public meeting date and time.
        $public_meeting_at = Carbon::now();
        $public_meeting_at->next($public_meeting_day_of_week);
        $public_meeting_at->hour = $public_meeting_time_hour;
        $public_meeting_at->minute = $public_meeting_time_minute;

        $congregation = new Congregation();
        $congregation->id = $id;
        $congregation->name = $name;
        $congregation->is_group = $is_group;
        $congregation->public_meeting_at = $public_meeting_at;

        $this->adminService->updateCongregation($congregation);

        return redirect()->route('list-congregations');
    }
}
