<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

abstract class AbstractParamFilter implements FilterInterface
{
    /**
     * @return mixed
     */
    abstract protected static function getName(): string;

    abstract protected function getValue();

    public function __invoke(array $notice): array
    {
        $notice['params'][static::getName()] = $this->getValue();

        return $notice;
    }
}
