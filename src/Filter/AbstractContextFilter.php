<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

abstract class AbstractContextFilter implements FilterInterface
{
    abstract protected static function getName();

    abstract protected function getValue(); //: string;

    public function __invoke($notice)
    {
        $notice['context'][static::getName()] = $this->getValue();
        return $notice;
    }
}
