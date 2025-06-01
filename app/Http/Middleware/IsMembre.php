<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsMembre
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié et si son rôle est 'membre'
        if (Auth::check() && Auth::user()->role === 'membre') {
            return $next($request);
        }

        // Sinon, accès interdit
        abort(403, 'Accès réservé aux membres.');
    }
}
