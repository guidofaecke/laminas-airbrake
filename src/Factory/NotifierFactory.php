<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Factory;

use Airbrake\Exception as AirbrakeException;
use Airbrake\Instance;
use Airbrake\Notifier;
use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function class_exists;
use function gettype;
use function is_callable;

/**
 * @psalm-suppress MissingConstructor
 */
class NotifierFactory
{
    protected ContainerInterface $container;

    /**
     * @throws ContainerExceptionInterface
     * @throws AirbrakeException
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, string $requestedName, ?array $options = null): Notifier
    {
        $this->container = $container;

        /** @var array $config */
        $config = $container->get('Config')['laminas_airbrake'];

        /** @var array $connectionConfig */
        $connectionConfig = $config['connection'];

        $notifier = new Notifier([
            'projectId'  => $connectionConfig['projectId'],
            'projectKey' => $connectionConfig['projectKey'],
            'host'       => $connectionConfig['host'],
        ]);
        $this->attachFilters($config['filters'], $notifier);

        Instance::set($notifier);

        return $notifier;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function attachFilters(array $filterCollection, Notifier $notifier): void
    {
        /** @var callable $filter */
        foreach ($filterCollection as $filter) {
            if (! is_callable($filter)) {
                $filter = $this->getFilter($filter);
            }

            $notifier->addFilter($filter);
        }
    }

    /**
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getFilter(string $filter)
    {
        if (! class_exists($filter)) {
            $filterInfo = gettype($filter);
            throw new InvalidArgumentException("The given filter of type `{$filterInfo}` is not a valid filter.");
        }

        return $this->container->get($filter);
    }
}
