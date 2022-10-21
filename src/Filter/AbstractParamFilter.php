<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

abstract class AbstractParamFilter implements FilterInterface
{
    /**
     * @return mixed
     */
    abstract protected static function getName();

    abstract protected function getValue(): string;

    public function __invoke($notice)
    {
        $notice['params'][static::getName()] = $this->getValue();
        return $notice;
    }
}
