<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserVerify
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
        if(auth()->check()){
            if($request->user()->user_verify == 1){
                return $next($request);
            }
            abort('403','บัญชีของคุณถูกระงับการใช้งานชั่วคราว');
        }
        return redirect()->route('login');
    }
}
