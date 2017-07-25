<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/


namespace FrankHouweling\ZendAirbrake\Filter;

use Airbrake\Errors\Notice;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\Request;
use Zend\Stdlib\RequestInterface;

/**
 * Interface FilterInterface
 * @package FrankHouweling\ZendAirbrake\Filter
 */
interface FilterInterface
{
    /**
     * @param array $notice
     * @param MvcEvent $mvcEvent
     * @return mixed
     */
    public function __invoke($notice);
}