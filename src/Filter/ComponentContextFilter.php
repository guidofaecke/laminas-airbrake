<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

class ComponentContextFilter extends AbstractLaminasRoutematchFilter
{
    protected static function getName(): string
    {
        return 'component';
    }

    /**
     * @return mixed|null
     */
    protected function getValue()
    {
        if ($this->getRoutematch() === null) {
            return null;
        }

        return $this->getRoutematch()->getParam('controller');
    }
}
