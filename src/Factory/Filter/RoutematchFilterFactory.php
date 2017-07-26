<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/

namespace FrankHouweling\ZendAirbrake\Factory\Filter;

use FrankHouweling\ZendAirbrake\Filter\RoutematchFilterInterface;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Application;
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RoutematchFilterFactory
 * @package FrankHouweling\ZendAirbrake\Factory\Filter
 */
class RoutematchFilterFactory implements AbstractFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @throws \InvalidArgumentException
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        if(!class_exists($requestedName))
        {
            throw new \InvalidArgumentException("The requested filter class `{$requestedName}` is not a valid classname"
                . ' or could not be loaded by the autoloader.');
        }
        if(!static::implementsInterface($requestedName))
        {
            throw new \InvalidArgumentException("The requested filter class `{$requestedName}` does not implement the"
                . ' RoutematchFilterInterface and cannot be loaded with the RoutematchFilterFactory.');
        }

        /** @var Application $application */
        $application = $container->get('Application');
        $routeMatch = $application->getMvcEvent()->getRouteMatch();
        $zendContextFilter = new $requestedName($routeMatch);
        return $zendContextFilter;
    }

    /**
     * @param $requestedName
     * @return bool
     */
    public static function implementsInterface($requestedName)
    {
        $implementations = class_implements($requestedName, RoutematchFilterInterface::class);
        $interfaceExists = isset($implementations[RoutematchFilterInterface::class]);
        return $interfaceExists;
    }

    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return class_exists($requestedName) && static::implementsInterface($requestedName);
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return $this->__invoke($serviceLocator, $requestedName);
    }

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return $this->canCreateServiceWithName($container, "", $requestedName);
    }
}