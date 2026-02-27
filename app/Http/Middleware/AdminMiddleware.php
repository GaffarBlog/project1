<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route_name = $request->route()?->getName();
        if (Auth::check()) {
            if ($route_name === 'admin.login.index') {
                return redirect()->route('admin.dashboard.view');
            } else {
                if (has_permission($route_name)) {
                    return $next($request);
                } else {
                    return redirect()->route('admin.dashboard.view')->with('warning', 'You do not have permission to access this route.');
                }

            }
        } else {
            if ($route_name === 'admin.login.index' || $route_name === 'admin.login.post') {
                return $next($request);
            } else {
                return redirect()->route('admin.login.index');
            }
        }
    }
}
