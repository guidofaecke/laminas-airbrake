<?php
/*
* Copyright (C) Senet Eindhoven B.V. - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace FrankHouweling\ZendAirbrake;
use Airbrake\ErrorHandler;
use Airbrake\Notifier;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package FrankHouweling\ZendAirbrake
 */
class Module
{
    /**
     * Used as the idenifier for confirugration for Zend Airbrake.
     */
    const CONFIG_MODULE_IDENTIFIER = 'zend_airbrake';

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    /**
     * @param $e
     */
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        // Error logging can be disabled from the application config, to make environment-specific logging possible.
        $config = $mvcEvent->getApplication()->getServiceManager()->get('Config');
        if($config[self::CONFIG_MODULE_IDENTIFIER]['log_errors'] === false)
        {
            return;
        }

        $eventManager = $mvcEvent->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'handleError'));
    }

    /**
     * @param MvcEvent $event
     */
    public function handleError(MvcEvent $mvcEvent)
    {
        $sm = $mvcEvent->getApplication()->getServiceManager();

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $sm->get(ErrorHandler::class);
        $errorHandler->onException($mvcEvent->getParam('exception'));
    }
}