<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Contracts\AdminService;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * UserController constructor.
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getList()
    {
        $users = $this->adminService->getUsers();
        return view('users.list-users')->with(compact('users'));
    }

    public function getNew()
    {
        return view('users.new-user');
    }

    public function postNew()
    {
    }

    public function getEdit()
    {
        return view('users.edit-user');
    }

    public function postEdit()
    {
    }
}
