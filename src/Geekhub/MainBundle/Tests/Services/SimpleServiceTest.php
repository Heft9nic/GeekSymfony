<?php

namespace Geekhub\MainBundle\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class SimpleServiceTest extends WebTestCase
{
    /**
     * @return string
     */
    public function testReturnServiceName()
    {
        $service = new SimpleService();
        $request = new Request(array('name' => 'TestingService'));
        $this->assertTrue(is_string($service->returnServiceName($request)));
    }
}
