<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OwnCors
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Definir una lista de orígenes permitidos
            $allowedOrigins = [
                'https://la-gloria-fc-store.vercel.app/',
                // Puedes añadir más dominios aquí si lo deseas
            ];

            // Obtener el origen de la solicitud
            $origin = $request->headers->get('Origin');

            // Establecer el encabezado CORS solo para los orígenes permitidos
            if (in_array($origin, $allowedOrigins)) {
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

            // Continuar con la solicitud
            $response = $next($request);

            // Añadir cabeceras a la respuesta
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }

            return $response;

        } catch (\Exception $e) {
            // Registrar el error con detalles
            Log::error('CORS Middleware Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            // Devolver error 500 con detalles (para todos los entornos)
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}