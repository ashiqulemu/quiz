<?php


namespace App\Http\Middleware;

use Closure;

class InitialMiddleware
{
    public function handle($request, Closure $next)
    {
      
        $uri = $request->path();
       
        view()->share('uri', $uri);
        if($request->user()){
            view()->share('user', $request->user());
        }
        return $next($request);
    }
}