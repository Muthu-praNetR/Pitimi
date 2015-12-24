<?php

namespace App\Http\Middleware;

use App;
use App\Locale;
use Auth;
use Closure;

/**
 * The LocaleSwitcher class.
 * @package App\Http\Middleware
 * @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class LocaleSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = $request->query('lang');

        if (isset($lang)) {
            $locale = Locale::where('code', $lang)->first();

            // Store language in session.
            if (isset($locale)) {
                session(['locale' => $locale]);

                // Store language into user's preferences.
                if (Auth::check()) {
                    $user = Auth::user();
                    $user->locale()->associate($locale);
                    $user->save();
                }
            }

        }

        $locale = session('locale');

        // Set locale for current request.
        if (isset($locale)) {
            App::setLocale($locale->code);
        }

        return $next($request);
    }
}
