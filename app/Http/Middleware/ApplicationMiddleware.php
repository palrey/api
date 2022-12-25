<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\Request;

class ApplicationMiddleware
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
        if (!$request->hasHeader('App-Token'))
            return response()->json('Missing App-Token Header', 401);
        $token = $request->header('App-Token');
        $application = Application::getByHash($token);
        if (!$application)
            return response()->json('App-Token no match', 401);
        $request->merge(['current_app' => $application]);
        return $next($request);
    }
}
