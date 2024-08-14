<?php

// app/Http/Middleware/CheckTokenPermissions.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$permissions
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $token = $request->bearerToken();
        $tokenPermissions = $this->getPermissionsByToken($token);

        if (!array_intersect($permissions, $tokenPermissions)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }

    private function getPermissionsByToken($token)
    {
        $tokenPermissionsMap = [
            '4b5f8f32c96a9aa152e0c6615d4e632f' => ['001', '002', '003', '004', '005', '006'],
            '117ae721e424e7f819893edb2c0c5fd6' => ['002', '003', '004'],
            '3b7d6e2cb06ba79a9c9744f8e256a39e' => ['005', '006'],
        ];

        return $tokenPermissionsMap[$token] ?? [];
    }
}