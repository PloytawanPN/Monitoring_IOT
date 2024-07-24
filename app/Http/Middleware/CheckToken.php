<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            $token = Session::get('_token');
            $user_token = DB::table('users')->where('remember_token', $token)->where('status',1)->count();
            if ($user_token > 0) {
                if ($request->is('signin')) {
                    return redirect('/dashboard');
                }
            } else {
                if (!$request->is('signin') && !$request->is('signup') && !$request->is('verifieldEmail/*')) {
                    return redirect('signin');
                }
            }
            return $next($request);
        } catch (NotFoundHttpException $e) {
            return redirect()->route('signin');
        }
    }
}
