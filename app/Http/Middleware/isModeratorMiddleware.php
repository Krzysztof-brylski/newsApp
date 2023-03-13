<?php

namespace App\Http\Middleware;

use App\Enums\UsersRolesEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isModeratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userRole=$request->user()->role;
        if( $userRole == UsersRolesEnum::ADMIN->value or $userRole == UsersRolesEnum::MODERATOR->value){
            return $next($request);
        }
        abort(403);
    }
}
