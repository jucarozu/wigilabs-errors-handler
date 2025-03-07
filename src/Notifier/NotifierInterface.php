<?php
namespace WigilabsErrorsHandler\Notifier;

interface NotifierInterface {
    public function notify(string $errorType, string $message): void;
}