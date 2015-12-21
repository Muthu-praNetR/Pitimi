<?php

namespace App\Http\Controllers;

/**
 * Class TalkController
 * @package App\Http\Controllers
 */
class TalkController extends Controller
{
    public function getList()
    {
        return view('talks.list-talks');
    }

    public function getNew()
    {
        return view('talks.new-talk');
    }

    public function postNew()
    {
    }

    public function getEdit()
    {
        return view('talks.edit-talk');
    }

    public function postEdit()
    {
    }
}
