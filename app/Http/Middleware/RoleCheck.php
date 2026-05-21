<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = $request->route()->uri();
        $rollID = $request->session()->get("role_id");

        // echo $rollID;die();
        if ($uri == "dashboard" || $uri == "logout") {
            return $next($request);
        } else {
            if ($rollID == 3) {
                if ($request->is('warehouse/*')) {
                    return $next($request);
                } else {
                    return redirect()->route("dashboard");
                }
            } else {
                if ($request->is("warehouse/*")) {
                    return redirect()->route("dashboard");
                } else {
                    return $next($request);
                }
            }
        }
        
    }
}
