<?php
/*
* This file is part of the Zend Airbrake module
*
* For license information, please view the LICENSE file that was distributed with this source code.
* Written by Frank Houweling <fhouweling@senet.nl>, 7/24/2017
*/


namespace FrankHouweling\ZendAirbrake\Filter;

use Zend\Http\PhpEnvironment\Request;
use Zend\Stdlib\RequestInterface;

/**
 * Class RemoteIpParamFilter
 * @package FrankHouweling\ZendAirbrake\Filter
 */
class RemoteIpParamFilter extends AbstractParamFilter
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * RemoteIpParamFilter constructor.
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    protected static function getName()
    {
        return "remote-ip";
    }

    /**
     * @return string
     */
    protected function getValue(): string
    {
        if(!($this->request instanceof Request))
        {
            return 'none';
        }
        return $this->request->getServer()->get('REMOTE_ADDR');
    }
}