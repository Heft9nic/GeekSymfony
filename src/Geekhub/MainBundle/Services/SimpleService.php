<?php

namespace Geekhub\MainBundle\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class SimpleService
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @return string
     */
    public function returnServiceName()
    {
        return 'My First Service in work with argument from URL - ' . $this->requestStack->getCurrentRequest()->get('name');
    }
}
