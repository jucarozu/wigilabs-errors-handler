<?php
namespace WigilabsErrorsHandler\Classifier;

use Throwable;
use WigilabsErrorsHandler\Exceptions\{
    TimeoutException,
    AuthenticationException,
    ValidationException
};

class ErrorClassifier {
    public function classify(Throwable $e): string {
        if ($e instanceof TimeoutException) {
            return ExceptionType::TIMEOUT;
        }

        if ($e instanceof AuthenticationException) {
            return ExceptionType::AUTHENTICATION;
        }

        if ($e instanceof ValidationException) {
            return ExceptionType::VALIDATION;
        }

        return ExceptionType::GENERIC;
    }
}