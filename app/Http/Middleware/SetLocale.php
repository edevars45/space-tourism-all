<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // On récupère la langue dans la session, sinon on prend celle du .env (APP_LOCALE) ou "fr"
        $locale = Session::get('locale', config('app.locale', 'fr'));

        if (! in_array($locale, ['fr', 'en'])) {
            $locale = 'fr';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
