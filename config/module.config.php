<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace FrankHouweling\ZendAirbrake;

use FrankHouweling\ZendAirbrake\Factory\Filter\RemoteIpParamFilterFactory;
use FrankHouweling\ZendAirbrake\Factory\Filter\RoutematchFilterFactory;
use FrankHouweling\ZendAirbrake\Factory\Filter\ZendContextFilterFactory;
use FrankHouweling\ZendAirbrake\Filter\ActionContextFilter;
use FrankHouweling\ZendAirbrake\Filter\ComponentContextFilter;
use FrankHouweling\ZendAirbrake\Filter\RemoteIpParamFilter;
use FrankHouweling\ZendAirbrake\Filter\RootDirectoryContextFilter;
use FrankHouweling\ZendAirbrake\Filter\ZendContextFilter;
use FrankHouweling\ZendAirbrake\Filter\ZendModuleContextFilter;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            \Airbrake\Notifier::class => \FrankHouweling\ZendAirbrake\Factory\NotifierFactory::class,
            \Airbrake\ErrorHandler::class => \FrankHouweling\ZendAirbrake\Factory\ErrorHandlerFactory::class,
            RemoteIpParamFilter::class => RemoteIpParamFilterFactory::class,
            ComponentContextFilter::class => RoutematchFilterFactory::class,
            ActionContextFilter::class => RoutematchFilterFactory::class,
            RootDirectoryContextFilter::class => InvokableFactory::class
        ]
    ],
    'zend_airbrake' => [
        'log_errors' => true,
        'filters' => [
            ComponentContextFilter::class,
            ActionContextFilter::class,
            RootDirectoryContextFilter::class
        ],
        'connection' => [
            'projectId' => '',
            'projectKey' => '',
            'host' => ''
        ]
    ]
];