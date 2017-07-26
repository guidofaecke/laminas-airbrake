# Zend Airbrake
Airbrake (phpbrake) integration for Zend Framework 3 (ZF3) or Zend Framework 2 (ZF2) via backwards compatibility for 2.5.x or newer.

Airbrake is a tool that captures and tracks your application's exceptions. This library connects your Zend application to Airbrake, to make exception tracking possible. It is also possible to use Zend Airbrake for different services that use the Airbrake protocol, like CodebaseHQ.

*Please note that this a pre-production release.*

## Installing
Use composer to install this module.
```shell
composer require frank-houweling/zend-airbrake
```
After composer installation, make sure that the \FrankHouweling\ZendAirbrake module is added to the module configuration.
In most cases, the module configuration can be found in `config/module.config.php`

## Connection configuration
It is required to correctly set the connection settings to connect to the Airbrake instance. These can be set in the
local Zend configuration (`config/autoload/local.php`).

```php
<?php
return [
    'zend_airbrake' => [
        'connection' => [
            'projectId' => YOUR_PROJECT_ID,
            'projectKey' => YOUR_PROJECT_KEY,
            'host' => YOUR_AIRBRAKE_HOST
        ]
    ]
];
```

## Custom airbrake filters
Custom filters can be defined to add extra params to the airbrake notification, or to alter context information.

### Writing a custom airbrake filter
Custom airbrake filters should be either functions requiring a notice array as paramater 
(as with [https://github.com/airbrake/phpbrake](phpbrake)), or a class implementing the FilterInterface (recommended).

For example:
```php
<?php
use \FrankHouweling\ZendAirbrake\Filter\FilterInterface;

class HelloWorldFilter implements FilterInterface
{
    public function __invoke($notice) 
    {
        $notice['params']['hello'] = 'world';
        return $notice;
    }   
}
```
To make sure the filter is used by Zend Airbrake, it should be added to the configuration.

```php
<?php

return [
    'zend_airbrake' => [
        // Your connections string etc.
        'filters' => [
            HelloWorldFilter::class
        ]
    ]
];
```

It is possible to use a factory for your Zend Airbrake filters. To make use of this, simply add the filter to your service manager configuration.

### Disabling airbrake for development environments
You might want to disable airbrake in the development environment. To do this, you can use the local zend configuration,
and set the `log_errors` configuration option to false.

For example, file: config/autload/local.php
```php
<?php

return [
    // Your connections string, filters etc.
    'zend_airbrake' => [
        'log_errors' => false
    ]
];
```

Via the zend local configuration, it is also possible to use different connection settings or different filters for
different environments.
