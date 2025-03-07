<?php
namespace WigilabsErrorsHandler\Exceptions;

use RuntimeException;

class AuthenticationException extends RuntimeException {
    public function __construct(
        string $message = "Authentication failed",
        int $code = 401
    ) {
        parent::__construct($message, $code);
    }
}