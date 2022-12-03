<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

use Laminas\Router\RouteMatch;

interface RoutematchFilterInterface
{
    public function __construct(RouteMatch $routematch);
}
