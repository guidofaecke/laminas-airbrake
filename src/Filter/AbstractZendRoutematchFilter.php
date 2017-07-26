<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/25/2017
*/

namespace FrankHouweling\ZendAirbrake\Filter;

use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Router\RouteMatch;
use Zend\Stdlib\RequestInterface;

/**
 * Class AbstractZendRoutematchFilter
 * @package FrankHouweling\ZendAirbrake\Filter
 */
abstract class AbstractZendRoutematchFilter extends AbstractContextFilter implements RoutematchFilterInterface
{
    /** @var RouteMatch */
    private $routematch;

    /**
     * AbstractZendRoutematchFilter constructor.
     * @param RouteMatch $routematch
     */
    public function __construct($routematch)
    {
        $this->routematch = $routematch;
    }

    protected function getRoutematch()
    {
        return $this->routematch;
    }
}