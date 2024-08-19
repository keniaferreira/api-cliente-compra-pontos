<?php

// app/Http/Middleware/CheckTokenPermissions.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenPermissions
{
    /**
     * Handle an incoming request and check for required permissions.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$permissions  Permissions required for the request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        // Obtém o token Bearer do cabeçalho da requisição
        $token = $request->bearerToken();
        
        // Recupera as permissões associadas ao token
        $tokenPermissions = $this->getPermissionsByToken($token);

        // Verifica se o token possui pelo menos uma das permissões necessárias
        if (!array_intersect($permissions, $tokenPermissions)) {
            // Retorna uma resposta de erro 403 (Não autorizado) se as permissões não coincidirem
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Continua o processamento da requisição se as permissões forem adequadas
        return $next($request);
    }

    /**
     * Retrieve permissions associated with the given token.
     *
     * @param  string  $token  The Bearer token
     * @return array  Array of permissions associated with the token
     */
    private function getPermissionsByToken($token)
    {
        // Mapeia tokens para permissões específicas
        $tokenPermissionsMap = [
            '4b5f8f32c96a9aa152e0c6615d4e632f' => ['001', '002', '003', '004', '005', '006'],
            '117ae721e424e7f819893edb2c0c5fd6' => ['002', '003', '004'],
            '3b7d6e2cb06ba79a9c9744f8e256a39e' => ['005', '006'],
        ];

        // Retorna as permissões associadas ao token ou um array vazio se o token não estiver no mapa
        return $tokenPermissionsMap[$token] ?? [];
    }
}
