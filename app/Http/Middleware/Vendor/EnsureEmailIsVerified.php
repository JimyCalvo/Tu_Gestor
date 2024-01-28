<?php

namespace App\Http\Middleware\Vendor;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerified
{

    public static function redirectTo($route)
    {
        return static::class.':'.$route;
    }


    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (!Config::get('services.email_verification')) {
            return $next($request);
        }

        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        return $next($request);
    }
}
