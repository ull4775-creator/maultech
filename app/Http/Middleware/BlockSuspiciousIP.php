<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlockSuspiciousIP
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        
        // Check if IP is blocked
        if(Cache::has('blocked_ip_' . $ip)) {
            abort(403, 'Your IP has been blocked due to suspicious activity.');
        }
        
        return $next($request);
    }
}