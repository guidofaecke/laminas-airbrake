<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

use Laminas\Router\RouteMatch;

abstract class AbstractLaminasRoutematchFilter extends AbstractContextFilter implements RoutematchFilterInterface
{
    private ?RouteMatch $routematch;

    public function __construct(?RouteMatch $routematch = null)
    {
        $this->routematch = $routematch;
    }

    protected function getRoutematch(): ?RouteMatch
    {
        return $this->routematch;
    }
}
