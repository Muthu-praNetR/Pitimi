<?php

namespace App\Http\Controllers;

use App\Services\Contracts\AdminService;
use App\Services\Contracts\CongregationService;
use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * The SpeakerController class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class SpeakerController extends Controller
{
    /**
     * @var CongregationService
     */
    private $congregationService;
    /**
     * @var AdminService
     */
    private $adminService;


    /**
     * SpeakerController constructor.
     * @param CongregationService $congregationService
     * @param AdminService $adminService
     */
    public function __construct(CongregationService $congregationService, AdminService $adminService)
    {
        $this->congregationService = $congregationService;
        $this->adminService = $adminService;
    }

    public function getList()
    {
        $speakers = $this->congregationService->getSpeakers();
        return view('speakers.list-speakers')->with(compact('speakers'));
    }

    public function getNew()
    {
        $congregations = $this->adminService->getAllCongregations();
        return view('speakers.new-speaker')->with(compact('congregations'));
    }

    public function postNew(Request $request)
    {
        $speaker = new Speaker();
        $speaker->first_name = $request->input('first_name');
        $speaker->last_name = $request->input('last_name');

        if (Auth::user()->is_admin) {
            $speaker->congregation_id = $request->input('congregation_id');
        }

        $this->congregationService->createSpeaker($speaker);

        return redirect()->route('list-speakers');
    }

    public function getEdit($id)
    {
        $speaker = $this->congregationService->getSpeaker($id);
        return view('speakers.edit-speaker')->with(compact('speaker'));
    }

    public function postEdit($id, Request $request)
    {
        $speaker = new Speaker();
        $speaker->id = $id;
        $speaker->first_name = $request->input('first_name');
        $speaker->last_name = $request->input('last_name');
        $this->congregationService->updateSpeaker($speaker);
        return redirect()->route('list-speakers');
    }
}
