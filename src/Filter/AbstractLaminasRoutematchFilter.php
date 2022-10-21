<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

abstract class AbstractLaminasRoutematchFilter extends AbstractContextFilter implements RoutematchFilterInterface
{
    private $routematch;

    public function __construct($routematch)
    {
        $this->routematch = $routematch;
    }

    protected function getRoutematch()
    {
        return $this->routematch;
    }
}
