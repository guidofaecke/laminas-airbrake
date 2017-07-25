<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/

namespace FrankHouweling\ZendAirbrake\Factory\Filter;

use FrankHouweling\ZendAirbrake\Filter\AbstractContextFilter;
use FrankHouweling\ZendAirbrake\Filter\RoutematchFilterInterface;
use FrankHouweling\ZendAirbrake\Filter\ZendContextFilter;
use Zend\Mvc\Application;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class RoutematchFilterFactory
 * @package FrankHouweling\ZendAirbrake\Factory\Filter
 */
class RoutematchFilterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        if(!class_exists($requestedName))
        {
            throw new \InvalidArgumentException("The requested filter class `{$requestedName}` is not a valid classname"
                . " or could not be loaded by the autoloader.");
        }
        if(!class_implements($requestedName, RoutematchFilterInterface::class))
        {
            throw new \InvalidArgumentException("The requested filter class `{$requestedName}` does not implement the"
                . " RoutematchFilterInterface and cannot be loaded with the RoutematchFilterFactory.");
        }

        /** @var Application $application */
        $application = $container->get('Application');
        $routeMatch = $application->getMvcEvent()->getRouteMatch();
        $zendContextFilter = new $requestedName($routeMatch);
        return $zendContextFilter;
    }
}