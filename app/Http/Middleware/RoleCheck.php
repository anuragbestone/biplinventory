<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\PermissionMaster;
use App\Models\ModuleMaster;

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
        if ($uri == "dashboard" || $uri == "logout" || $uri == "mail") {
            return $next($request);
        } else {
            if ($rollID == 3) {
                if ($request->is('warehouse/*')) {
                    return $next($request);
                } else {
                    return redirect()->route("dashboard")->with("error", "You don't have permission to access the route!!");
                }
            } else {
                if ($request->is("warehouse/*")) {
                    return redirect()->route("dashboard")->with("error", "You don't have permission to access the route!!");
                } else {

                    $moduleRoute = ModuleMaster::select("id", "module_route")
                        ->where("module_route", $uri)
                        ->first();

                    if ($moduleRoute) {

                        $permissionStatus = PermissionMaster::where("module_id", $moduleRoute->id)
                            ->where("role_id", $rollID)
                            ->exists();

                        if ($permissionStatus) {
                            return $next($request);
                        } else {
                            return redirect()->route("dashboard")->with("error", "You don't have permission to access the route!!");
                        }

                    } else {
                        return redirect()->route("dashboard")->with("error", "Route not found!!");
                    }
                
                }
            }
        }
        
    }
}
