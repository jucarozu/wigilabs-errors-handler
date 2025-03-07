<?php
namespace WigilabsErrorsHandler\Logger\Sanitizer;

class SensitiveDataSanitizer {
    public static function sanitize(array $context): array {
        $sensitiveKeys = ['password', 'api_key', 'token'];
        return array_map(function ($value) use ($sensitiveKeys) {
            return in_array($value, $sensitiveKeys) ? '***' : $value;
        }, $context);
    }
}