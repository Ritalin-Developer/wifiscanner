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
        '/5465295406:AAH_GzsIj6xd2IPukMhK-c1GJzpQQpCWHm0/webhook',
        '/start'
    ];
}
