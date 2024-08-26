<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnCors
{
    /*
    Handle an incoming request.*
    @param \Illuminate\Http\Request $request
    @param \Closure $next
    @return mixed
    */
public function handle(Request $request, Closure $next){
        // Definir una lista de orígenes permitidos
        $allowedOrigins = ['https://la-gloria-fc-store.vercel.app/', 'http://localhost:3000'];

        // Obtener el origen de la solicitud
        $origin = $request->headers->get('Origin');

        // Verificar si el origen está en la lista de permitidos
        if (in_array($origin, $allowedOrigins)) {
            // Establecer el encabezado CORS solo para los orígenes permitidos
            header("Access-Control-Allow-Origin: $origin");
        }

        // Definir las cabeceras adicionales
        $headers = [
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization'
        ];

        // Manejar solicitudes OPTIONS (Preflight)
        if ($request->getMethod() == "OPTIONS") {
            return response('OK')->withHeaders($headers);
        }

        // Continuar con la siguiente middleware o controlador
        $response = $next($request);

        // Añadir cabeceras a la respuesta
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
