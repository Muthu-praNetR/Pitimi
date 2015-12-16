<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CongregationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * The AuthController class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class AuthController extends Controller
{
    /**
     * The congregation service.
     *
     * @var CongregationService
     */
    protected $congregationService;

    # Constructor.

    /**
     * Construct a AuthController.
     *
     * @param CongregationService $congregationService The congregation service.
     */
    public function __construct(CongregationService $congregationService)
    {
        $this->congregationService = $congregationService;
    }

    # Actions.

    /**
     * View the login form.
     *
     * @return View
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Login a user.
     *
     * @param Request $request The request.
     *
     * @return Response A response.
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if ($this->congregationService->authenticate($email, $password)) {
            return redirect('/');
        }

        return redirect('/login');
    }

    /**
     * Logout the user.
     *
     * @return Response A response.
     */
    public function logout()
    {
        $this->congregationService->logout();

        return redirect('/login');
    }
}
