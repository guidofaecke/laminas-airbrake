<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

interface FilterInterface
{
    public function __invoke(array $notice): array;
}
