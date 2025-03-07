<?php
namespace Tests\Retry;

use Exception;
use PHPUnit\Framework\TestCase;
use WigilabsErrorsHandler\Retry\ExponentialBackoffRetrier;
use WigilabsErrorsHandler\Exceptions\TimeoutException;

class ExponentialBackoffRetrierTest extends TestCase {
    /**
     * @throws Exception
     */
    public function testRetryExceedsMaxAttempts() {
        $this->expectException(TimeoutException::class);
        $retrier = new ExponentialBackoffRetrier();
        $retrier->retry(function () {
            throw new TimeoutException();
        }, 2);
    }
}