<?php
namespace WigilabsErrorsHandler\Retry;

interface RetryStrategyInterface {
    public function retry(callable $operation, int $maxAttempts = 3): callable;
}