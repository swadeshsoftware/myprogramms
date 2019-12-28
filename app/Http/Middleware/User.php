<?php 
namespace App\Http\Middleware;

use Closure;
use Auth; //at the top

class User {
    public function handle($request, Closure $next)
    {

        if ( Auth::check() && Auth::user()->role == 'user' ){
            return $next($request);
        }else {
           return redirect('/');
        }

        

    }

}