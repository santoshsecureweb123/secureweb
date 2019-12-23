<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsSuperAdmin
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
         if(Auth::user()->role_id == 1)
            {
                 session(['user_id' => Auth::user()->id,'role_id' => Auth::user()->role_id]);
                return $next($request);
            }else{
                return redirect()->back();
            }
      
    }
}
