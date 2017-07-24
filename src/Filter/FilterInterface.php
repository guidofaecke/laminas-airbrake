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
    public function __invoke($notice): void;
}