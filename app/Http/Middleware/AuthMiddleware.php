<?php

namespace App\Http\Middleware;

use Closure;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(!$request->user()) {
            return redirect('/login')->withErrors(['auth' => 'You are unauthenticated']);
        } 

        $user = $request->user();


        if($user->role == 'asesi' && !$user->asesi->is_filled && $request->path() != 'asesi/profile') {
            return redirect('/asesi/profile');
        }

        if($user->role == 'admin' && !$user->admin &&  $request->path() != 'admin/profile') {
            return redirect('/admin/profile');
        }

        $userRole = $request->user()->role;
        $isValidatedRoles = $roles[0] == 'all' || (is_array($roles) ? in_array($userRole, $roles) : $roles == $userRole);
        
        if($isValidatedRoles) {
            return $next($request);
        }

        
        
        $request->session()->invalidate();
        return redirect('/login')->withErrors(['auth' => 'You are unauthorized']);
    }
}
