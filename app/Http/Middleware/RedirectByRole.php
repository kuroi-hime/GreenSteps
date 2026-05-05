<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            $role = auth()->user()->role->nom_role;
            if($role != 'admin' && $request->routeIs('dashboard'))
                return redirect()->route('home');  
        }
        return $next($request);
    }
}
