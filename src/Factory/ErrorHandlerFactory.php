<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace FrankHouweling\ZendAirbrake\Factory;

use Airbrake\ErrorHandler;
use Airbrake\Notifier;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ErrorHandlerFactory
 * @package FrankHouweling\ZendAirbrake\Factory
 */
class ErrorHandlerFactory implements FactoryInterface
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = NULL)
    {
        $notifier = $container->get(Notifier::class);
        $errorHandler = new ErrorHandler($notifier);
        $errorHandler->register();
        return $errorHandler;
    }
}