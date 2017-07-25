<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/


namespace FrankHouweling\ZendAirbrake\Filter;

/**
 * Class ComponentContextFilter
 * @package FrankHouweling\ZendAirbrake\Filter
 */
class ComponentContextFilter extends AbstractZendRoutematchFilter
{
    /**
     * @return string
     */
    protected static function getName()
    {
        return "component";
    }

    /**
     * @return string
     */
    protected function getValue(): string
    {
        $controller = $this->getRoutematch()->getParam('controller');
        return $controller;
    }

}