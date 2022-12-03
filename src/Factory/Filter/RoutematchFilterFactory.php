<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Factory\Filter;

use GuidoFaecke\LaminasAirbrake\Filter\RoutematchFilterInterface;
use InvalidArgumentException;
use Laminas\Mvc\Application;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

use function class_exists;
use function class_implements;

class RoutematchFilterFactory
{
    /**
     * @throws InvalidArgumentException
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container, string $requestedName): object
    {
        if (! class_exists($requestedName)) {
            throw new InvalidArgumentException("The requested filter class `{$requestedName}` is not a valid classname"
                . ' or could not be loaded by the autoloader.');
        }
        if (! static::implementsInterface($requestedName)) {
            throw new InvalidArgumentException("The requested filter class `{$requestedName}` does not implement the"
                . ' RoutematchFilterInterface and cannot be loaded with the RoutematchFilterFactory.');
        }

        /** @var Application $application */
        $application = $container->get('Application');
        $routeMatch  = $application->getMvcEvent()->getRouteMatch();

        return new $requestedName($routeMatch);
    }

    /**
     * @param object|string $requestedName
     */
    public static function implementsInterface($requestedName): bool
    {
        $implementations = class_implements($requestedName);

        return isset($implementations[RoutematchFilterInterface::class]);
    }
}
