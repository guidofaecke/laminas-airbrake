<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake;

use Airbrake\ErrorHandler;
use Laminas\Mvc\MvcEvent;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Module
{
    /**
     * @psalm-suppress MixedReturnStatement
     * @psalm-suppress MixedInferredReturnType
     */
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @psalm-suppress MixedArrayAccess
     * @psalm-suppress MixedAssignment
     */
    public function onBootstrap(MvcEvent $mvcEvent): void
    {
        // Error logging can be disabled from the application config, to make environment-specific logging possible.
        $config = $mvcEvent->getApplication()->getServiceManager()->get('Config');
        if ($config['laminas_airbrake']['log_errors'] === false) {
            return;
        }

        $eventManager = $mvcEvent->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'handleError']);
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @psalm-suppress MixedAssignment
     */
    public function handleError(MvcEvent $mvcEvent): void
    {
        $sm        = $mvcEvent->getApplication()->getServiceManager();
        $exception = $mvcEvent->getParam('exception');

        // Skip errors without Exception.
        if ($exception === null) {
            return;
        }

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $sm->get(ErrorHandler::class);

        $errorHandler->onException($exception);
    }
}
