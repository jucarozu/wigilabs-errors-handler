<?php
namespace Tests\Classifier;

use PHPUnit\Framework\TestCase;
use WigilabsErrorsHandler\Classifier\ErrorClassifier;
use WigilabsErrorsHandler\Exceptions\{
    TimeoutException,
    AuthenticationException,
    ValidationException
};

class ErrorClassifierTest extends TestCase {
    public function testClassifyTimeoutException(): void {
        $classifier = new ErrorClassifier();
        $result = $classifier->classify(new TimeoutException());
        $this->assertEquals('timeout', $result);
    }

    public function testClassifyAuthenticationException(): void {
        $classifier = new ErrorClassifier();
        $result = $classifier->classify(new AuthenticationException());
        $this->assertEquals('authentication', $result);
    }

    public function testClassifyValidationException(): void {
        $classifier = new ErrorClassifier();
        $result = $classifier->classify(new ValidationException());
        $this->assertEquals('validation', $result);
    }
}