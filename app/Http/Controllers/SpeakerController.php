<?php

namespace App\Http\Controllers;

use App\Services\Contracts\AdminService;
use App\Services\Contracts\CongregationService;
use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * The SpeakerController class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class SpeakerController extends Controller
{
    /**
     * The congregation service.
     * @var CongregationService
     */
    private $congregationService;

    /**
     * The admin service.
     * @var AdminService
     */
    private $adminService;


    /**
     * SpeakerController constructor.
     *
     * @param CongregationService $congregationService
     * @param AdminService        $adminService
     */
    public function __construct(CongregationService $congregationService, AdminService $adminService)
    {
        $this->congregationService = $congregationService;
        $this->adminService = $adminService;
    }

    /**
     * Show the list of speakers.
     * @return $this
     */
    public function getList()
    {
        $speakers = $this->congregationService->getSpeakers();
        return view('speakers.list-speakers')->with(compact('speakers'));
    }

    /**
     * Show a form to create a new speaker.
     * @return $this
     */
    public function getNew()
    {
        $congregations = $this->adminService->getAllCongregations()->pluck('name', 'id');
        $talks = $this->congregationService->getAllTalks()->pluck('number', 'id');
        return view('speakers.new-speaker')->with(compact('congregations', 'talks'));
    }

    /**
     * Process a form to create a new speaker.
     *
     * @param Request $request The request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNew(Request $request)
    {
        // Get input data.
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $talk_ids = $request->input('selected_talk_ids');

        // Create new speaker.
        $speaker = new Speaker();
        $speaker->first_name = $request->input('first_name');
        $speaker->last_name = $request->input('last_name');

        if (Auth::user()->is_admin) {
            $speaker->congregation_id = $request->input('congregation_id');
        }

        $speaker = $this->congregationService->createSpeaker($speaker);

        // Add prepared talks.
        $this->congregationService->addPreparedTalks($speaker, $talk_ids);

        return redirect()->route('list-speakers');
    }

    /**
     * Show a form to edit a speaker.
     *
     * @param $id int The id of the speaker.
     *
     * @return $this
     */
    public function getEdit($id)
    {
        $speaker = $this->congregationService->getSpeaker($id);
        return view('speakers.edit-speaker')->with(compact('speaker'));
    }

    /**
     * Process a form to edit a speaker.
     *
     * @param         $id      int The id of the speaker.
     * @param Request $request The request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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
