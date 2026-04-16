<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SanitizationService;

class SanitizeInput
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isJson()) {
            $input = $request->json()->all();
        } else {
            $input = $request->all();
        }

        $sanitized = $this->sanitizeInput($input);

        if ($request->isJson()) {
            $request->json()->replace($sanitized);
        } else {
            $request->replace($sanitized);
        }

        return $next($request);
    }

    private function sanitizeInput(array $data): array
    {
        return array_map(function ($value) {
            if (is_array($value)) {
                return $this->sanitizeInput($value);
            }

            if (is_string($value) && !in_array($value, ['', '0'])) {
                return trim($value);
            }

            return $value;
        }, $data);
    }
}
