<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $is_admin): Response
    {                   // column table name
        if ($request->user()->is_admin === $is_admin) {
            // return to_route('admin.dashboard');
            return $next($request);
        }
        return to_route('dashboard');
    }
    // protected $routeMiddleware = [
    //     // other middleware
    //     'is_admin' => \App\Http\Middleware\RoleMiddleware::class,
    // ];
}
