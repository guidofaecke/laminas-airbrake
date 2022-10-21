<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

class ActionContextFilter extends AbstractLaminasRoutematchFilter
{
    protected static function getName()
    {
        return 'action';
    }

    protected function getValue(): string
    {
        return $this->getRoutematch()->getParam('action');
    }
}
