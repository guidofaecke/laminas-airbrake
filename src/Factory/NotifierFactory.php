<?php
/*
* Copyright (C) Senet Eindhoven B.V. - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace FrankHouweling\ZendAirbrake\Factory;

use Airbrake\Instance;
use Airbrake\Notifier;
use FrankHouweling\ZendAirbrake\Filter\FilterInterface;
use FrankHouweling\ZendAirbrake\Module;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Stdlib\Request;
use Zend\Stdlib\RequestInterface;

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
        $config = $container->get('Config')[Module::CONFIG_MODULE_IDENTIFIER];
        /** @var array $connectionConfig */
        $connectionConfig = $config['connection'];
        $notifier = new Notifier([
            'projectId' => $connectionConfig['projectId'],
            'projectKey' => $connectionConfig['projectKey'],
            'host' => $connectionConfig['host']
        ]);
        Instance::set($notifier);

        $request = $container->get('Request');
        $this->attachFilters($config['filters'], $notifier, $request);
        return $notifier;
    }

    /**
     * @param array $filterCollection
     * @param Notifier $notifier
     */
    private function attachFilters(array $filterCollection, Notifier $notifier, RequestInterface $request)
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
        if(!class_exists($filter))
        {
            $filterInfo = gettype($filter);
            throw new \InvalidArgumentException("The given filter of type `{$filterInfo}` is not a valid filter.");
        }
        return $this->container->get($filter);
}