<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale');

        if ($locale && in_array($locale, ['uz', 'ru', 'en'])) {
            App::setLocale($locale);
        } else {
            App::setLocale(config('app.locale')); // fallback
        }

        return $next($request);
    }
}
