<?php

namespace GuidoFaecke\LaminasAirbrake\Factory\Filter;

use GuidoFaecke\LaminasAirbrake\Filter\RemoteIpParamFilter;
use Laminas\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

class RemoteIpParamFilterFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RemoteIpParamFilter
    {
        $request = $container->get('Request');
        assert($request instanceof Request);

        return new RemoteIpParamFilter($request);
    }
}
