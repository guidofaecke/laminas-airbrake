<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

class ComponentContextFilter extends AbstractLaminasRoutematchFilter
{
    protected static function getName(): string
    {
        return 'component';
    }

    protected function getValue(): string
    {
        return $this->getRoutematch()->getParam('controller');
    }
}
