<?php

namespace Rangoo\Lockscreen\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class RedirectIfNotUnlocked extends Authenticate
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param array $guards
	 *
	 * @return mixed
	 */
    public function handle($request, Closure $next, ...$guards)
    {
		$this->authenticate($guards);

		if(session()->get('lockscreen', false))
			return redirect(config('lockscreen.redirects.locked', '/lockscreen'));

		return $next($request);
    }
}
