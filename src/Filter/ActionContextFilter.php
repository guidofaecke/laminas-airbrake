<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

class ActionContextFilter extends AbstractLaminasRoutematchFilter
{
    protected static function getName(): string
    {
        return 'action';
    }

    protected function getValue(): string
    {
        return $this->getRoutematch()->getParam('action');
    }
}
