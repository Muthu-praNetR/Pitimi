<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * The MenuComposer class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class MenuComposer
{
    # Properties.

    protected $request;

    # Constructor.

    /**
     * Create a new menu composer.
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
        $menu = [
            [
                'text' => 'Calendar',
                'icon' => 'calendar',
                'url' => url('/'),
                'active' => $this->request->is('/'),
            ],
            [
                'text' => 'Speakers',
                'icon' => 'user',
                'url' => url('/speakers'),
                'active' => $this->request->is('/speaker*'),
            ],
            [
                'text' => 'Talks',
                'icon' => 'file-text-o',
                'url' => url('/talks'),
                'active' => $this->request->is('/talk*'),
            ],
            [
                'text' => 'Users',
                'icon' => 'cog',
                'url' => url('/users'),
                'active' => $this->request->is('/user*'),
            ],
            [
                'text' => 'Logout',
                'icon' => 'sign-out',
                'url' => url('/logout'),
                'active' => $this->request->is('/logout*'),
            ],
        ];

        $view->with('menu', $menu);
    }
}
