<?php 
namespace App\Http\Middleware;

use Closure;
use Auth; //at the top

class Admin {

    public function handle($request, Closure $next)
    {
         //echo "hii123";die;
        if ( Auth::check() && Auth::user()->role == 'admin' ){
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'sub-admin') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'employee') {
            return $next($request);
        }
        else {
           return redirect()->route('admin-login');
        }

        

    }

}