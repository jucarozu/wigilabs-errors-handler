<?php
namespace WigilabsErrorsHandler\Classifier;

class ExceptionType {
    const TIMEOUT = 'timeout';
    const AUTHENTICATION = 'authentication';
    const VALIDATION = 'validation';
    const GENERIC = 'generic';

    /**
     * Get all valid types.
     * @return array
     */
    public static function getAllTypes(): array {
        return [
            self::TIMEOUT,
            self::AUTHENTICATION,
            self::VALIDATION,
            self::GENERIC
        ];
    }
}