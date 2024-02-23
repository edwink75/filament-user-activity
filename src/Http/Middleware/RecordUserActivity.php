<?php

namespace Edwink\FilamentUserActivity\Http\Middleware;

use Closure;
use Edwink\FilamentUserActivity\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RecordUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Perform action
        if (Auth::id() !== null) {
            UserActivity::create([
                'url' => config('app.url').'/'.$request->path(),
                'user_id' => Auth::id(),
            ]);
        }

        return $response;
    }
}
