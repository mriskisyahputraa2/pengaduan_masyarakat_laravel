<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // auth admin dan auuth kan admin jika level nya admin
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->level == 'admin'){
            return $next($request);
        }

        // jika tidak maka bawa user kehalaman formLogin
        return redirect()->route('admin.formLogin');
    }
}
