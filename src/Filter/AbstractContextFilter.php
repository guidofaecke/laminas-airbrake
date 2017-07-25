<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/

namespace FrankHouweling\ZendAirbrake\Filter;

/**
 * Class AbstractRequestFilter
 * @package FrankHouweling\ZendAirbrake\Filter
 */
abstract class AbstractContextFilter implements FilterInterface
{
    /**
     * Returns the param name.
     * @return mixed
     */
    abstract protected static function getName();

    /**
     * Returns the param value.
     * @return string
     */
    abstract protected function getValue() : string;

    /**
     * @param array $notice
     * @return array
     */
    public function __invoke($notice)
    {
        $notice['context'][static::getName()] = $this->getValue();
        return $notice;
    }
}