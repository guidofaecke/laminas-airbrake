<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

abstract class AbstractContextFilter implements FilterInterface
{
    abstract protected static function getName(): string;

    abstract protected function getValue(): string;

    public function __invoke(array $notice): array
    {
        $notice['context'][static::getName()] = $this->getValue();
        return $notice;
    }
}
