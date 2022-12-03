<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

class ActionContextFilter extends AbstractLaminasRoutematchFilter
{
    protected static function getName(): string
    {
        return 'action';
    }

    /**
     * @return mixed|null
     */
    protected function getValue()
    {
        if ($this->getRoutematch() === null) {
            return null;
        }

        return $this->getRoutematch()->getParam('action');
    }
}
