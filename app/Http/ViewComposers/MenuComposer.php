<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

/**
 * The MenuComposer class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class MenuComposer
{
    # Constructor.

    /**
     * Create a new menu composer.
     */
    public function __construct()
    {
    }

    # Methods.

    /**
     * Bind data to the view.
     *
     * @param View $view The view.
     */
    public function compose(View $view)
    {
        $view->with('menu', [
            ['text' => 'Calendar', 'url' => url('/')],
            ['text' => 'Speakers', 'url' => url('/speakers')],
            ['text' => 'Talks',    'url' => url('/talks')],
            ['text' => 'Users',    'url' => url('/users')],
            ['text' => 'Logout',   'url' => url('/logout')],
        ]);
    }
}
