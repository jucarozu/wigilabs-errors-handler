<?php
namespace WigilabsErrorsHandler\Statistics;

class ErrorTracker {
    private array $stats = [];

    public function track(string $type): void {
        $this->stats[$type] = ($this->stats[$type] ?? 0) + 1;
    }

    public function getStats(): array {
        return $this->stats;
    }
}