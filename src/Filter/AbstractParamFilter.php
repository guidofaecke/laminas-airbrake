<?php
/*
* Copyright (C) Senet Eindhoven B.V. - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace FrankHouweling\ZendAirbrake\Filter;

use Airbrake\Errors\Notice;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\RequestInterface;

/**
 * Class AbstractParamFilter
 * @package FrankHouweling\ZendAirbrake\Filter
 */
abstract class AbstractParamFilter implements FilterInterface
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
     * @param RequestInterface $request
     * @return array
     */
    public function __invoke($notice)
    {
        $notice['context'][static::getName()] = $this->getValue();
        return $notice;
    }
}