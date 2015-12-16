<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getList()
    {
        return view('users.list-users');
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
