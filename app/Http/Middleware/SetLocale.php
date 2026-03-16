<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $first_segment = $request->segment(1);

        $available_locales = ['en', 'ar'];

        // If locale exists in URL
        if (in_array($first_segment, $available_locales)) {

            App::setLocale($first_segment);
            URL::defaults(['locale' => $first_segment]);

            // Save locale in session
            Session::put('locale', $first_segment);

            return $next($request);
        }

        // If no locale in URL, get it from session
        $locale = Session::get('locale', config('app.fallback_locale'));

        $segments = $request->segments();
        array_unshift($segments, $locale);

        return redirect(implode('/', $segments));
    }
}
