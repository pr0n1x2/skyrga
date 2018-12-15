<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorMiddleware
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
        if (Auth::check()
            && (Auth::user()->role == User::AUTHOR_ROLE
                || Auth::user()->role == User::USER_ROLE
                || Auth::user()->role == User::ADMIN_ROLE)) {
            return $next($request);
        }

        return redirect('home');
    }
}
