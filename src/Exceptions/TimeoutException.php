<?php
namespace WigilabsErrorsHandler\Exceptions;

use RuntimeException;

class TimeoutException extends RuntimeException {
    public function __construct(
        string $message = "Request timeout",
        int $code = 408
    ) {
        parent::__construct($message, $code);
    }
}