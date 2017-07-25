<?php
/*
* Copyright (C) Senet Eindhoven B.V. - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/


namespace FrankHouweling\ZendAirbrake\Factory\Filter;

use FrankHouweling\ZendAirbrake\Filter\RemoteIpParamFilter;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class RemoteIpParamFilterFactory
 * @package FrankHouweling\ZendAirbrake\Factory\Filter
 */
class RemoteIpParamFilterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $request = $container->get('Request');
        $remoteIpParamFilter = new RemoteIpParamFilter($request);
        return $remoteIpParamFilter;
    }
}