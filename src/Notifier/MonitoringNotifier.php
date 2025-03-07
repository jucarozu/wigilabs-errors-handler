<?php
namespace WigilabsErrorsHandler\Notifier;

class MonitoringNotifier implements NotifierInterface {
    public function notify(string $errorType, string $message): void {
        $this->sendToPrometheus($errorType);
        $this->sendToSlack($message);
    }

    private function sendToPrometheus(string $errorType): void {
        // TODO: Implement notification to Prometheus
    }

    private function sendToSlack(string $message): void {
        // TODO: Implement notification to Slack
    }
}