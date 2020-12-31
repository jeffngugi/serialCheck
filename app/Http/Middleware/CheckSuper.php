<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckSuper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role_id != 1){
            // Flash::error('STOP! Only permitted users can access that');
            return redirect()->back()->with('error','Permision denied!');
        }
        return $next($request);
    }
}
