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
        // dd(auth()->check());
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request);
        // redirect()->route('posts.dashboard');
        }
        else{

            return redirect()->route('home.index');
        }

    }
}
