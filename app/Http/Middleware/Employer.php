<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(null ===  $request->user() || (null === $request->user()->employer)){
            return redirect()->route('employer.create')
                ->with('error', 'You need to register as an employer first');
        }

        return $next($request); // let laravel do further action that it needs to do
    }
}
