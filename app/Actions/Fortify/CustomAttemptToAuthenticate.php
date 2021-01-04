<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Fortify;

class CustomAttemptToAuthenticate extends AttemptToAuthenticate
{
    public function handle($request, $next)
    {
        if (Fortify::$authenticateUsingCallback) {
            return $this->handleUsingCustomCallback($request, $next);
        }
        if ($this->guard->attempt(
            $request->only(Fortify::username(), 'password'),
            $request->input('remember'))
        ) {
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }
}
