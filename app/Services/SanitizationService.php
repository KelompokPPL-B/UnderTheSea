<?php

namespace App\Services;

class SanitizationService
{
    /**
     * Sanitize user input to prevent XSS attacks
     */
    public static function sanitize(?string $input): ?string
    {
        if ($input === null) {
            return null;
        }

        return trim(strip_tags($input));
    }

    /**
     * Sanitize array of inputs
     */
    public static function sanitizeArray(array $data): array
    {
        return array_map(function ($value) {
            if (is_array($value)) {
                return self::sanitizeArray($value);
            }
            return is_string($value) ? self::sanitize($value) : $value;
        }, $data);
    }

    /**
     * Escape HTML entities for safe display
     */
    public static function escape(?string $input): ?string
    {
        return $input ? htmlspecialchars($input, ENT_QUOTES, 'UTF-8') : $input;
    }

    /**
     * Sanitize file name to prevent directory traversal
     */
    public static function sanitizeFilename(?string $filename): ?string
    {
        if ($filename === null) {
            return null;
        }

        return preg_replace('/[^a-zA-Z0-9._-]/', '', basename($filename));
    }
}
