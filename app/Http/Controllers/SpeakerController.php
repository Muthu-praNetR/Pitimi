<?php

namespace App\Http\Controllers;

/**
 * The SpeakerController class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class SpeakerController extends Controller
{

    public function getList()
    {
        return view('speakers.list-speakers');
    }

    public function getNew()
    {
        return view('speakers.new-speaker');
    }

    public function postNew()
    {
    }

    public function getEdit()
    {
        return view('speakers.edit-speaker');
    }

    public function postEdit()
    {
    }
}
