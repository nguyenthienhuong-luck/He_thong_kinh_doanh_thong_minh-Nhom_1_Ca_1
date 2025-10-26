<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
     public function handle($request, Closure $next)
     {
         // Check if user is authenticated and has admin role
         if (Auth::check() && Auth::user()->isAdmin == 1) {
             return $next($request);
         }
 
         // Redirect or return unauthorized access
         return redirect()->route('home.dashboard')->with('type', 'danger')->with('message', 'Bạn phải nâng cấp tài khoản mới sử dụng được chức năng này!');
     }
}
