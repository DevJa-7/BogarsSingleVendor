<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class CustomerAuthenticate extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $user = auth()->user();
        if ($this->auth->guard()->check() && $user->type == 'customer') {
            return $next($request);
        }
        return redirect('/customer/login');
    }
}
