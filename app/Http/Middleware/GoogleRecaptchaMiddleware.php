<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleRecaptchaMiddleware
{
    /**
     * Handle an incoming request.
     * Middleware для верификации каптчи через сервис google. Вам достаточно добавить в .env параметр
            CAPTCHA_SITE_SECRET c вашим секретным ключом
     *
     * @param Request $request
     * @param Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env("CAPTCHA_SITE_SECRET"),
            'response' => $request->get("g-recaptcha-response")
        ])->json();

        return isset($response["success"]) && $response["success"] === true ? $next($request) : false;
    }
}
