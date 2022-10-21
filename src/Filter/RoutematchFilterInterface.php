<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

use Laminas\Router\RouteMatch;

interface RoutematchFilterInterface
{
    public function __construct($routematch);
}
