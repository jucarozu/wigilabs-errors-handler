<?php
namespace WigilabsErrorsHandler\Retry;

use Exception;
use RuntimeException;
use WigilabsErrorsHandler\Exceptions\TimeoutException;

class ExponentialBackoffRetrier implements RetryStrategyInterface {

    /**
     * @throws Exception
     */
    public function retry(callable $operation, int $maxAttempts = 3): callable {
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                return $operation();
            } catch (\Exception $e) {
                if (!$this->isRetryable($e) || $attempt === $maxAttempts) {
                    throw $e;
                }
                sleep(2 ** ($attempt - 1));
            }
        }

        throw new RuntimeException("All retry attempts exhausted");
    }

    private function isRetryable(\Throwable $e): bool {
        return $e instanceof TimeoutException || $e->getCode() >= 500;
    }
}