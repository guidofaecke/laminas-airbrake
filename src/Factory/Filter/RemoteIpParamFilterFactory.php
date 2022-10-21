<?php

namespace GuidoFaecke\LaminasAirbrake\Factory\Filter;

use GuidoFaecke\LaminasAirbrake\Filter\RemoteIpParamFilter;
use Psr\Container\ContainerInterface;

class RemoteIpParamFilterFactory
{
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        array $options = null
    ) {
        $request = $container->get('Request');

        return new RemoteIpParamFilter($request);
    }
}
