<?php
/*
* Copyright (C) Senet Eindhoven B.V. - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/

namespace FrankHouweling\ZendAirbrake;

use FrankHouweling\ZendAirbrake\Filter\RemoteIpParamFilter;

return [
    'service_manager' => [
        'factories' => [
            \Airbrake\Notifier::class => \FrankHouweling\ZendAirbrake\Factory\NotifierFactory::class,
            \Airbrake\ErrorHandler::class => \FrankHouweling\ZendAirbrake\Factory\ErrorHandlerFactory::class
        ]
    ],
    Module::CONFIG_MODULE_IDENTIFIER => [
        'log_errors' => true,
        'filters' => [
            RemoteIpParamFilter::class
        ],
        'connection' => [
            'projectId' => '',
            'projectKey' => '',
            'host' => ''
        ]
    ]
];