<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class restrictKeyword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->input('title');
        $category = $request->input('name');

        if (stripos($post, 'facebook') !== false || stripos($category, 'facebook') !== false) {
            return abort(403,'("facebook") keyword is NOT ALLWAED.');
        }
        return $next($request);
    }
}
