<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   // this package need to be imported excplicitely
 
class AdminMiddleware
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
        if(Auth::check())
        {
            if(Auth::user()->role_as=='1')  //1->admin user else normal user
            {
                return $next($request);
            }
            else
            {
                return redirect('/home')->with('status','Access Denied as your are not an Admin');
            }
        }
        else
        {
            return redirect('/login')->with('status','Please login first');
        }
    }
}
