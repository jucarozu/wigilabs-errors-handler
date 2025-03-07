<?php
namespace WigilabsErrorsHandler\Logger;

use Psr\Log\AbstractLogger;
use WigilabsErrorsHandler\Logger\Sanitizer\SensitiveDataSanitizer;

class SafeLogger extends AbstractLogger {
    public function log($level, $message, array $context = []): void {
        $cleanContext = SensitiveDataSanitizer::sanitize($context);
        error_log(sprintf("[%s] %s - %s", $level, $message, json_encode($cleanContext)));
    }
}