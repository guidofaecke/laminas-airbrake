<?php

namespace GuidoFaecke\LaminasAirbrake\Filter;

use Laminas\Http\PhpEnvironment\Request;
use Laminas\Stdlib\RequestInterface;

class RemoteIpParamFilter extends AbstractParamFilter
{
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    protected static function getName()
    {
        return 'remote-ip';
    }

    protected function getValue(): string
    {
        if (! $this->request instanceof Request) {
            return 'none';
        }

        return $this->request->getServer()->get('REMOTE_ADDR');
    }
}
