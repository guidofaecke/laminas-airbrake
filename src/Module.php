<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
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
        if($config['zend_airbrake']['log_errors'] === false)
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
        $exception = $mvcEvent->getParam('exception');

        // Skip errors without Exception.
        if($exception === null)
        {
            return;
        }

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $sm->   get(ErrorHandler::class);
        $errorHandler->onException($exception);
    }
}