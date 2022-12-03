<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

use Laminas\Router\RouteMatch;

abstract class AbstractLaminasRoutematchFilter extends AbstractContextFilter implements RoutematchFilterInterface
{
    private ?RouteMatch $routematch;

    public function __construct(?RouteMatch $routematch)
    {
        $this->routematch = $routematch;
    }

    protected function getRoutematch(): ?RouteMatch
    {
        return $this->routematch;
    }
}
