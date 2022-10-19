<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

use function getcwd;

class RootDirectoryContextFilter extends AbstractContextFilter
{
    protected static function getName(): string
    {
        return 'rootDirectory';
    }

    protected function getValue(): string
    {
        return getcwd();
    }
}
