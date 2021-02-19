<?php


namespace App\Http\Middleware;


use App\User;
use Closure;

class CheckAdminLogin
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
        if(auth()->user()){
            $user = User::find(auth()->user()->id);
            if ($user->role == 'admin' || $user->role == 'sub-admin') {
                return redirect('/admin/dashboard');
            }
        }
        return $next($request);
    }
}
