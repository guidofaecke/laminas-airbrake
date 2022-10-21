<?php
/*
* This file is part of the Laminas Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace GuidoFaecke\LaminasAirbrake;

use Airbrake\ErrorHandler;
use Airbrake\Notifier;
use GuidoFaecke\LaminasAirbrake\Factory\ErrorHandlerFactory;
use GuidoFaecke\LaminasAirbrake\Factory\Filter\RemoteIpParamFilterFactory;
use GuidoFaecke\LaminasAirbrake\Factory\Filter\RoutematchFilterFactory;
use GuidoFaecke\LaminasAirbrake\Factory\NotifierFactory;
use GuidoFaecke\LaminasAirbrake\Filter\ActionContextFilter;
use GuidoFaecke\LaminasAirbrake\Filter\ComponentContextFilter;
use GuidoFaecke\LaminasAirbrake\Filter\RemoteIpParamFilter;
use GuidoFaecke\LaminasAirbrake\Filter\RootDirectoryContextFilter;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories'          => [
            Notifier::class                   => NotifierFactory::class,
            ErrorHandler::class               => ErrorHandlerFactory::class,
            RemoteIpParamFilter::class        => RemoteIpParamFilterFactory::class,
            RootDirectoryContextFilter::class => InvokableFactory::class,
            RoutematchFilterFactory::class    => InvokableFactory::class,
        ],
    ],
    'laminas_airbrake' => [
        'log_errors' => true,
        'filters'    => [
            ComponentContextFilter::class,
            ActionContextFilter::class,
            RootDirectoryContextFilter::class
        ],
        'connection' => [
            'projectId'  => '',
            'projectKey' => '',
            'host'       => ''
        ]
    ]
];
