<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

use function getcwd;

class RootDirectoryContextFilter extends AbstractContextFilter
{
    protected static function getName()
    {
        return 'rootDirectory';
    }

    protected function getValue(): string
    {
        return getcwd();
    }
}
