<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CongregationService;
use App\Speaker;
use Illuminate\Http\Request;

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
     * SpeakerController constructor.
     * @param CongregationService $congregationService
     */
    public function __construct(CongregationService $congregationService)
    {
        $this->congregationService = $congregationService;
    }

    public function getList()
    {
        $speakers = $this->congregationService->getSpeakers();
        return view('speakers.list-speakers')->with(compact('speakers'));
    }

    public function getNew()
    {
        return view('speakers.new-speaker');
    }

    public function postNew(Request $request)
    {
        $speaker = new Speaker();
        $speaker->first_name = $request->input('first_name');
        $speaker->last_name = $request->input('last_name');
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
