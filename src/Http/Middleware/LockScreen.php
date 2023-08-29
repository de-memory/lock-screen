<?php

namespace DeMemory\LockScreen\Http\Middleware;

use Dcat\Admin\Support\Helper;
use Illuminate\Http\Request;

class LockScreen
{
    protected array $except = [
        'auth/login',
        'auth/logout',
        'auth/lock',
        'auth/unlock',
    ];

    public function handle(Request $request, \Closure $next)
    {
        if ($this->shouldPassThrough($request)) {
            return $next($request);
        }

        if ($request->session()->has(\DeMemory\LockScreen\LockScreen::LOCK_KEY)) {
            return admin_redirect('auth/lock');
        }

        return $next($request);
    }

    protected function shouldPassThrough(Request $request): bool
    {
        if ($request->routeIs(admin_api_route_name('value'))) {
            return true;
        }

        foreach ($this->except as $except) {
            if ($request->routeIs($except))
                return true;

            $except = admin_base_path($except);

            if ($except !== '/')
                $except = trim($except, '/');

            if (Helper::matchRequestPath($except))
                return true;
        }

        return false;
    }


}
