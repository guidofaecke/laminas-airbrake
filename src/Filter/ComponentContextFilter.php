<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

class ComponentContextFilter extends AbstractLaminasRoutematchFilter
{
    protected static function getName()
    {
        return 'component';
    }

    protected function getValue(): string
    {
        return $this->getRoutematch()->getParam('controller');
    }
}
