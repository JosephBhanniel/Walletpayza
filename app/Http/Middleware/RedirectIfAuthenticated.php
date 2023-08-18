<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->isCompany()) {
                return redirect(RouteServiceProvider::COMPANY_HOME);
            } elseif ($user->isEmployee()) {
                return redirect(RouteServiceProvider::EMPLOYEE_HOME);
            } elseif ($user->isAdmin()) {
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }
        }

        return $response;
    }
}
