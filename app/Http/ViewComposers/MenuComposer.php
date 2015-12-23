<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * The MenuComposer class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class MenuComposer
{
    # Properties.

    protected $request;

    # Constructor.

    /**
     * Create a new menu composer.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    # Methods.

    /**
     * Bind data to the view.
     *
     * @param View $view The view.
     */
    public function compose(View $view)
    {
        $route_name = $this->request->route() ? $this->request->route()->getName() : '';

        $menu = [
            [
                'text'   => 'Calendar',
                'icon'   => 'calendar',
                'url'    => url('/'),
                'active' => $route_name === 'calendar',
            ],
            [
                'text'   => 'Speakers',
                'icon'   => 'user',
                'url'    => url('/speakers'),
                'active' => $this->request->is('speaker*'),
            ],
        ];

        if (Auth::check() && Auth::user()->is_admin) {
            $menu = array_merge($menu, [
                [
                    'text'   => 'Talks',
                    'icon'   => 'file-text-o',
                    'url'    => url('/talks'),
                    'active' => $this->request->is('talk*'),
                ],
                [
                    'text'   => 'Congregations',
                    'icon'   => 'building-o',
                    'url'    => url('/congregations'),
                    'active' => $this->request->is('congregation*'),
                ],
                [
                    'text'   => 'Users',
                    'icon'   => 'cog',
                    'url'    => url('/users'),
                    'active' => $this->request->is('user*'),
                ]
            ]);
        }

        $view->with('menu', $menu);
    }
}
