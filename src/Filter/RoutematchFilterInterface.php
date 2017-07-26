<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/


namespace FrankHouweling\ZendAirbrake\Filter;

use Zend\Mvc\Router\RouteMatch;

/**
 * Interface RoutematchFilterInterface
 * @package FrankHouweling\ZendAirbrake\Filter
 */
interface RoutematchFilterInterface
{
    /**
     * RoutematchFilterInterface constructor.
     * @param RouteMatch $routematch
     */
    public function __construct($routematch);
}