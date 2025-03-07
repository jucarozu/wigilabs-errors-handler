# Wigilabs Errors Handler

## Componente de Manejo de Errores para un Backend Proxy

Un sistema robusto para detectar, clasificar y manejar errores en aplicaciones PHP que actúan como proxy entre clientes y servicios externos (SOAP/REST). Diseñado para integrarse con CodeIgniter y Slim Framework, y desplegarse en **RedHat OpenShift**.

## Características Principales

- **Clasificación de Errores**: Detecta timeouts, fallos de autenticación, errores de validación y más.
- **Reintentos con Backoff Exponencial**: Maneja errores transitorios automáticamente.
- **Logging Seguro**: Sanitiza datos sensibles (API keys, contraseñas) antes de registrar.
- **Integración con Monitoreo**: Notifica a Prometheus, Slack u otros sistemas.
- **Estadísticas en Tiempo Real**: Cuenta y categoriza errores para análisis posterior.

---

## Instalación

```bash
composer require wigilabs/wigilabs-errors-handler
```

## Ejemplos de uso

### 1. **Clasificación de Errores**

```php
use WigilabsErrorsHandler\Classifier\ErrorClassifier;
use WigilabsErrorsHandler\Exceptions\TimeoutException;

// Initialize classifier
$classifier = new ErrorClassifier();

try {
    // Code that may throw exceptions
} catch (\Throwable $e) {
    // Classify exception type (timeout, auth, validation, etc.)
    $errorType = $classifier->classify($e);
    // Example output: ExceptionType::TIMEOUT
}
```

### 2. **Reintentos con Backoff Exponencial**

```php
use WigilabsErrorsHandler\Retry\ExponentialBackoffRetrier;
use WigilabsErrorsHandler\Exceptions\TimeoutException;

$retrier = new ExponentialBackoffRetrier();

try {
    $result = $retrier->retry(
        function() use ($externalService) {
            return $externalService->fetchData(); // Your external call
        },
        maxAttempts: 3 // Optional (default: 3)
    );
} catch (TimeoutException $e) {
    // Handle final failure after all retries
}
```

### 3. **Logging Seguro**

```php
use WigilabsErrorsHandler\Logger\SafeLogger;

$logger = new SafeLogger();

try {
    // Operation with sensitive data
    $userData = ['email' => 'user@example.com', 'password' => 'secret'];
} catch (\Exception $e) {
    // Auto-sanitizes fields like 'password', 'token'
    $logger->error("Login failed", $userData);
    // Logs: [error] Login failed - {"email":"user@example.com","password":"***"}
}
```

### 4. **Integración con Monitoreo**

```php
use WigilabsErrorsHandler\Notifier\MonitoringNotifier;

$notifier = new MonitoringNotifier();

// Configure monitoring channels (example)
$notifier->configure([
    'prometheus' => [
        'endpoint' => 'http://prometheus:9090',
        'job' => 'proxy-backend'
    ],
    'slack' => [
        'webhook' => $_ENV['SLACK_WEBHOOK']
    ]
]);

// Send critical alerts
$notifier->notify(
    ExceptionType::AUTHENTICATION, 
    "Invalid API credentials detected"
);
```

### 5. **Estadísticas en Tiempo Real**

```php
use WigilabsErrorsHandler\Statistics\ErrorTracker;
use WigilabsErrorsHandler\Classifier\ExceptionType;

$tracker = new ErrorTracker();

// Track errors during requests
$tracker->track(ExceptionType::TIMEOUT);
$tracker->track(ExceptionType::VALIDATION);

// Get metrics for dashboard
$stats = $tracker->getStats();
/*
[
    'timeout' => 1,
    'validation' => 1
]
*/
```