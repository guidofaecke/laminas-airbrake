<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/


namespace FrankHouweling\ZendAirbrake\Filter;

/**
 * Class RootDirectoryContextFilter
 * @package FrankHouweling\ZendAirbrake\Filter
 */
class RootDirectoryContextFilter extends AbstractContextFilter
{
    /**
     * @return string
     */
    protected static function getName()
    {
        return 'rootDirectory';
    }

    /**
     * @return string
     */
    protected function getValue(): string
    {
        return getcwd();
    }
}