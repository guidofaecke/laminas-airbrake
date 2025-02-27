<?php

declare(strict_types=1);

namespace GuidoFaecke\LaminasAirbrake\Filter;

use Laminas\Http\PhpEnvironment\Request;
use Laminas\Stdlib\RequestInterface;

class RemoteIpParamFilter extends AbstractParamFilter
{
    /** @var RequestInterface|mixed  */
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    protected static function getName(): string
    {
        return 'remote-ip';
    }

    /**
     * @return mixed|string
     */
    protected function getValue()
    {
        if (! $this->request instanceof Request) {
            return 'none';
        }

        return $this->request->getServer()->get('REMOTE_ADDR');
    }
}
