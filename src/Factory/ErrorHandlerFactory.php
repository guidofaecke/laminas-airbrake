<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Factory;

use Airbrake\ErrorHandler;
use Airbrake\Notifier;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ErrorHandlerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, string $requestedName, ?array $options = null): ErrorHandler
    {
        $notifier = $container->get(Notifier::class);

        $errorHandler = new ErrorHandler($notifier);
        $errorHandler->register();

        return $errorHandler;
    }
}
