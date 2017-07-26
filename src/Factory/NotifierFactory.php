<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace FrankHouweling\ZendAirbrake\Factory;

use Airbrake\Instance;
use Airbrake\Notifier;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class NotifierFactory
 * @package FrankHouweling\ZendAirbrake\Factory
 */
class NotifierFactory implements FactoryInterface
{
    protected $container;

    /**
     * @param \Interop\Container\ContainerInterface $container
     * @param string $requestedName
     * @param array|NULL $options
     * @return Notifier
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = NULL)
    {
        $this->container = $container;

        /** @var array $config */
        $config = $container->get('Config')['zend_airbrake'];
        /** @var array $connectionConfig */
        $connectionConfig = $config['connection'];
        $notifier = new Notifier([
            'projectId' => $connectionConfig['projectId'],
            'projectKey' => $connectionConfig['projectKey'],
            'host' => $connectionConfig['host']
        ]);
        $this->attachFilters($config['filters'], $notifier);

        Instance::set($notifier);

        return $notifier;
    }

    /**
     * @param array $filterCollection
     * @param Notifier $notifier
     */
    private function attachFilters(array $filterCollection, Notifier $notifier)
    {
        /** @var callable $filter */
        foreach($filterCollection as $filter)
        {
            if(!is_callable($filter))
            {
                $filter = $this->getFilter($filter);
            }

            $notifier->addFilter($filter);
        }
    }

    /**
     * @param $filter
     * @return mixed
     */
    private function getFilter($filter)
    {
        if (!class_exists($filter))
        {
            $filterInfo = gettype($filter);
            throw new \InvalidArgumentException("The given filter of type `{$filterInfo}` is not a valid filter.");
        }
        return $this->container->get($filter);
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this->__invoke($serviceLocator, "");
    }
}