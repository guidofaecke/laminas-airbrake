<?php

declare(strict_types=1);

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
    'service_manager'  => [
        'factories' => [
            ActionContextFilter::class        => InvokableFactory::class,
            ComponentContextFilter::class     => InvokableFactory::class,
            ErrorHandler::class               => ErrorHandlerFactory::class,
            Notifier::class                   => NotifierFactory::class,
            RemoteIpParamFilter::class        => RemoteIpParamFilterFactory::class,
            RootDirectoryContextFilter::class => InvokableFactory::class,
            RoutematchFilterFactory::class    => InvokableFactory::class,
        ],
    ],
    'laminas_airbrake' => [
        'log_errors' => true,
        'filters'    => [
            ActionContextFilter::class,
            ComponentContextFilter::class,
            RootDirectoryContextFilter::class,
        ],
        'connection' => [
            'projectId'  => '',
            'projectKey' => '',
            'host'       => '',
        ],
    ],
];
