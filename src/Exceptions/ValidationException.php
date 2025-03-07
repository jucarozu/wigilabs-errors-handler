<?php
namespace WigilabsErrorsHandler\Exceptions;

use RuntimeException;
use Throwable;

class ValidationException extends RuntimeException {
    public function __construct(
        string $message = "Invalid input data",
        int $code = 422,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}