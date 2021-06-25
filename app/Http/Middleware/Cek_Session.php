<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Session;

class Cek_Session
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
        if (Session::get('token') !== 'SPSBNI' || Session::get('status') !== 'LOGGED' || Session::get('username') === NULL) {
            return redirect('/');
        }

        return $next($request);
    }
}
