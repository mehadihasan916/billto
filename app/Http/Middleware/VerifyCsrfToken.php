<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Logout: excluded to avoid 419 on frontend (session/cookie same-origin issues).
        // Risk is limited to "force logout" only; no data exposure.
        'logout',
    ];
}
