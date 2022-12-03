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

    /**
     * @return false|string
     */
    protected function getValue()
    {
        return getcwd();
    }
}
