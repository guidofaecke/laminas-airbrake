<?php

namespace GuidoFaecke\LaminasAirbrake\Factory;

use Airbrake\ErrorHandler;
use Airbrake\Notifier;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

class ErrorHandlerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): ErrorHandler
    {
        $notifier = $container->get(Notifier::class);
        assert($notifier instanceof Notifier);

        $errorHandler = new ErrorHandler($notifier);
        $errorHandler->register();

        return $errorHandler;
    }
}
