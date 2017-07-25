<?php
/*
* Copyright (C) Senet Eindhoven B.V. - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
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