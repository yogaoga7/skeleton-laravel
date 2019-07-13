<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            
            $user = Auth::user();
            
            $accesses = [];
            $accessSlug = [];
            foreach($user->roles as $role) {
                foreach($role->access as $access) {
                    if($access->url) {
                        $accesses[] = request()->is(ltrim($access->url, '/') . '*');
                        $accessSlug[] = $access->uniqkey;
                    }
                }
            }
            if(in_array(true, $accesses)) {
                $request->permissionsAccess = $accessSlug;
                return $next($request);
            }

            return abort(403);
        }

        return abort(403);
    }
}
