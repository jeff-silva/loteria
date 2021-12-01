<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        // header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');

        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: *');
        // header('Access-Control-Allow-Headers: *');

        // header('Access-Control-Allow: *');
        // header('Access-Control-Allow-: *');
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        // header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application, X-CSRF-Token');
        
        return $next($request);
    }
}
