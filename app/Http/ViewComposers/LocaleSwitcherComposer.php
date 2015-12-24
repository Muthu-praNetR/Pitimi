<?php

namespace App\Http\ViewComposers;

use App\Locale;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * The LocaleSwitcherComposer class.
 * @package App\Http\ViewComposers
 * @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class LocaleSwitcherComposer
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
        $view->with('locales', Locale::all());
    }
}
