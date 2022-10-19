<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Factory\Filter;

use GuidoFaecke\LaminasAirbrake\Filter\RemoteIpParamFilter;
use Psr\Container\ContainerInterface;

class RemoteIpParamFilterFactory
{
    public function __invoke(
        ContainerInterface $container,
        string $requestedName,
        ?array $options = null
    ): RemoteIpParamFilter {
        $request = $container->get('Request');

        return new RemoteIpParamFilter($request);
    }
}
