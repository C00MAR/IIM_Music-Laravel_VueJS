<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiKey;
use Illuminate\Support\Facades\Auth;


class VerifyApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = "039a2700-043a-46c6-857f-537401327a5a";
        // $apiKey = $request->header('x-api-key');
        
        if (!$apiKey) {
            return response()->json(['error' => 'API Key not provided'], 401);
        }

        $apiKeyRecord = ApiKey::where('key', $apiKey)->first();

        if (!$apiKeyRecord) {
            return response()->json(['error' => 'Invalid API Key'], 401);
        }

        return $next($request);
    }
}
