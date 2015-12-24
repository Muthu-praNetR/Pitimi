<?php

namespace App\Http\Controllers;
use App\Services\Contracts\AdminService;

/**
 * The TalkController class.
 * @package App\Http\Controllers
 * @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class TalkController extends Controller
{
    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * TalkController constructor.
     *
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Show a list of talks.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $talks = $this->adminService->getTalks();
        return view('talks.list-talks')->with(compact('talks'));
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
