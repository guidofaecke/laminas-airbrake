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

/**
 * Class NotifierFactory
 * @package FrankHouweling\ZendAirbrake\Factory
 */
class NotifierFactory implements FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = NULL)
    {
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
        $this->attachFilters($config['filters'], $notifier);
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
        if(!class_exists($filter))
        {
            $filterInfo = gettype($filter);
            throw new \InvalidArgumentException("The given filter of type `{$filterInfo}` is not a valid filter.");
        }
        return new $filter;
    }
}