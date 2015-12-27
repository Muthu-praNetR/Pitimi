<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Session;

/**
 * The Controller class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($message)
    {
        $this->message('success', $message);
    }

    protected function warning($message)
    {
        $this->message('warning', $message);
    }

    protected function danger($message)
    {
        $this->message('danger', $message);
    }

    protected function info($message)
    {
        $this->message('info', $message);
    }

    private function message($type, $message)
    {
        $messages = Session::get('messages', [
            'success' => [],
            'warning' => [],
            'danger'  => [],
            'info'    => [],
        ]);

        $messages[$type][] = $message;

        Session::flash('messages', $messages);
    }

}
