<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class ForceToHTTPS
{
    public function handle(Request $request, Closure $next): Response
    {
        if (str_ends_with($request->getHost(), 'aplikasidesapatumbak1-production.up.railway.app')) {
            URL::forceScheme('https');
        }
        return $next($request);
    }
}
